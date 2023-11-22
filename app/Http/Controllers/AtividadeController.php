<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Inscricao;
use League\Csv\Writer;
use League\Csv\CharsetConverter;
use Illuminate\Support\Facades\Log;


class AtividadeController extends Controller
{
    public function index()
    {
        $atividades = Atividade::all();

        return response()->json($atividades);
    }

    public function store(Request $request)
    {
        $atividade = new Atividade;
        $atividade->fill($request->all());
        $atividade->save();

        return response()->json(['message' => 'Sucesso!', 'content' => $atividade]);
    }

    public function show($id)
    {
        $atividade = Atividade::find($id);

        return response()->json($atividade);
    }

    public function showByEventId($eventoId)
    {
        $atividades = Atividade::where('evento_id', $eventoId)->get();
       
        if ($atividades->isEmpty()) {
            return response()->json(['error' => 'Nenhuma atividade encontrada.'], 404);
        }

        return response()->json($atividades);
    }

    public function update(Request $request, $id)
    {
        $atividade = Atividade::findOrFail($id);

        $atividade->fill($request->all());

        $validacao_data_atividade = $this->validate_data_atividade($atividade);

        if ($validacao_data_atividade->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $validacao_data_atividade->getData()->message],
                $validacao_data_atividade->getStatusCode()
            );
        }

        $validacao_data_registro = $this->validate_data_registro($atividade);

        if ($validacao_data_registro->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $validacao_data_registro->getData()->message],
                $validacao_data_registro->getStatusCode()
            );
        }

        $validacao_numero_vagas = $this->validate_numero_vagas($atividade);

        if ($validacao_numero_vagas->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $validacao_numero_vagas->getData()->message],
                $validacao_numero_vagas->getStatusCode()
            );
        }

        $atividade->save();

        return response()->json($atividade);
    }

    public function destroy($id)
    {
        $atividade = Atividade::findOrFail($id);

        $atividade->delete();

        return response()->json(['message' => 'Atividade removida com sucesso']);
    }

    public function validate_data_atividade(Atividade $atividade)
    {
        $data_inicial = strtotime($atividade->horario_inicio);
        $data_final = strtotime($atividade->horario_encerramento);

        if ($data_inicial > $data_final) 
        {
            return response()->json(['message' => 'Data inicial maior do que data final da atividade'], 400);
        }

        return response()->json(['message' => 'Sucesso!'], 200);
    }

    public function validate_data_registro(Atividade $atividade)
    {
        $data_cadastro = strtotime($atividade->created_at);
        $data_update = strtotime($atividade->updated_at);

        if ($data_cadastro > $data_update) 
        {
            return response()->json(['message' => 'Data de cadastro maior do que data de atualização de registro da atividade'], 400);
        }

        return response()->json(['message' => 'Sucesso!'], 200);
    }

    public function validate_numero_vagas(Atividade $atividade){

        if ($atividade->quantidade_vagas < 0) 
        {
            return response()->json(['message' => 'Quantidade de vagas para a atividade inválida'], 400);
        }

        return response()->json(['message' => 'Sucesso!'], 200);
    }
   
    public function gerarRelatorio($id)
    {
        Log::info('Gerando relatório para atividade ID: ' . $id);
        // Buscar a atividade pelo ID
        $atividade = Atividade::find($id);

        if (!$atividade) {
            Log::error('Atividade não encontrada para gerar relatório.');
            return response()->json(['error' => 'Atividade não encontrada.'], 404);
        }

        // Buscar as inscrições relacionadas a essa atividade
        $inscricoes = Inscricao::where('atividade_id', $id)->get();

        if ($inscricoes->isEmpty()) {
            return response()->json(['message' => 'Nenhuma inscrição encontrada para esta atividade.'], 404);
        }

        // Gerar o arquivo CSV
        $csvFileName = 'relatorio_atividade_' . $atividade->id . '.csv';
        $csvPath = storage_path('app/csv/' . $csvFileName);

        $csv = Writer::createFromPath($csvPath, 'w+');
        CharsetConverter::addTo($csv, 'UTF-8', 'ISO-8859-1');

        // Adicionar cabeçalhos ao CSV
        $csv->insertOne(['ID', 'Nome', 'Email', 'CPF', 'Check-in']);

        // Adicionar dados ao CSV
        foreach ($inscricoes as $inscricao) {
            $csv->insertOne([$inscricao->id, $inscricao->nome, $inscricao->email, $inscricao->cpf, $inscricao->checkin ? 'Presente' : 'Ausente']);
        }
         Log::info('Resposta da geração de relatório:', ['csv_path' => $csvPath]);
        // Retornar o caminho do arquivo CSV gerado
        return Response::download($csvPath, $csvFileName);
    }

    
}
