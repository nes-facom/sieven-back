<?php

namespace App\Http\Controllers;

use App\Models\Participacao;
use App\Models\Atividade;
use Illuminate\Http\Request;

class ParticipacaoController extends Controller
{
    public function index()
    {
        $participacoes = Participacao::all();
        

        return response()->json($participacoes);
    }

    public function store(Request $request)
    {
        $participacao = new Participacao;

        $participacao->fill($request->all());

        $response = $this->validate_register_date($participacao);
        
        if ($response->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $response->getData()->message],
                $response->getStatusCode()
            );
        }

        $response = $this->validate_activity_status($participacao);
        
        if ($response->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $response->getData()->message],
                $response->getStatusCode()
            );
        }
        
        $response = $this->validate_participation_status($participacao);
        
        if ($response->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $response->getData()->message],
                $response->getStatusCode()
            );
        }
        
        $participacao->save();

        return response()->json($participacao);
    }

    public function show($id)
    {
        $participacao = Participacao::find($id);

        return response()->json($participacao);
    }

    public function showByAtividade($atividade_id)
    {
        $participacoes = Participacao::where('atividade_id', $atividade_id)->get();

        if ($participacoes->isEmpty()) {
            return response()->json(['error' => 'Nenhuma participação encontrada.'], 404);
        }

        return view('participacoes.index', compact('participacoes'));
    }

    public function showByUser($user_id)
    {
        $participacoes = Participacao::where('user_id', $user_id)->get();

        if ($participacoes->isEmpty()) {
            return response()->json(['error' => 'Nenhuma participação encontrada.'], 404);
        }

        return view('participacoes.index', compact('participacoes'));
    }

    public function update(Request $request, $id)
    {
        $participacao = Participacao::findOrFail($id);

        $participacao->fill($request->all());

        $response = $this->validate_register_date($participacao);
        
        if ($response->getStatusCode() != 200) 
        {
            return response()->json(
                ['message' => $response->getData()->message],
                $response->getStatusCode()
            );
        }

        $participacao->save();

        return response()->json($participacao);
    }

    public function destroy($id)
    {
        $participacao = Participacao::findOrFail($id);

        $participacao->delete();

        return response()->json(['message' => 'Participação removida com sucesso']);
    }

    public function validate_register_date(Participacao $participacao)
    {
        $data_registro = strtotime($participacao->created_at);
        $data_update = strtotime($participacao->updated_at);

        if($data_registro == Null || $data_update == Null)
        {
            return response()->json(['message' => 'Datas de registro vazias'], 400);
        }

        else if($data_registro <= $data_update)
        {
            return response()->json(['message' => 'Datas de registro corretas'], 200);
        }

        else
        {
            return response()->json(['message' => 'Data de registro maior do que data de atualização'], 400);
        }
    }

    public function validate_activity_status(Participacao $participacao)
    {   
        $atividade = Atividade::find($participacao->atividade_id);

        if ($atividade->situacao == "Ativa")
        {
            return response()->json(['message' => 'Situação da atividade válida'], 200);
        }

        else 
        {
            return response()->json(['message' => 'Inscrições só podem ser cadastradas em atividades com situação igual a "Ativa"'], 400);
        }
    }
    
    public function validate_participation_status(Participacao $participacao)
    {
        if ($participacao->situacao == "Inscrito")
        {
            return response()->json(['message' => 'Situação válida'], 200);
        }

        else 
        {
            return response()->json(['message' => 'Participação deve ser cadastrada com situação igual a "Ativa"'], 400);
        }
    }
}
