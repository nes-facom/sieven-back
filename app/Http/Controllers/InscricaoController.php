<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Atividade;
use App\Mail\InscricaoCriada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\Image\RendererInterface;
use BaconQrCode\Writer;



class InscricaoController extends Controller
{
    public function index()
    {
        // Lógica para mostrar uma lista de recursos
    }

    public function create()
    {
        // Lógica para exibir o formulário de criação
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        $atividade = Atividade::find($dados['atividade_id']);
        $numeroMaximoInscricoes = $atividade->quantidade_vagas;

        $numeroInscricoesAtuais = Inscricao::where('atividade_id', $dados['atividade_id'])->count();

        if ($numeroInscricoesAtuais >= $numeroMaximoInscricoes) {
            return response()->json(['mensagem' => 'Número máximo de inscrições atingido para esta atividade'], 400);
        }

        //Ainda não sei se isso aqui em baixo funciona
        // $horarioInicioAtividade = $atividade->horario_inicio;

        // if (Carbon::now()->greaterThan(Carbon::parse($horarioInicioAtividade))) {
        //     return response()->json(['mensagem' => 'A atividade já começou, não é possível se inscrever.'], 400);
        // }

        $inscricao = Inscricao::create($dados);

        $qrCode = 'http://localhost:8080/#/' . $inscricao->uuid->toString();

        Mail::to($inscricao->email)->
            send(new InscricaoCriada($inscricao, $qrCode));

        return response()->json(['mensagem' => 'Inscrição criada com sucesso', 'inscricao' => $inscricao], 200);


    }

    public function show($id)
    {
        // Lógica para mostrar um recurso específico
    }

    public function edit($id)
    {
        // Lógica para exibir o formulário de edição
    }

    public function update(Request $request, $id)
    {
        // Lógica para atualizar um recurso no banco de dados
    }

    public function destroy($id)
    {
        // Lógica para excluir um recurso do banco de dados
    }
}
