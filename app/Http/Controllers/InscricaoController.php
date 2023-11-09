<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Atividade;
use App\Models\Evento;
use App\Mail\InscricaoCriada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use chillerlan\Authenticator\{Authenticator, AuthenticatorOptionsTrait};
use chillerlan\Authenticator\Authenticators\AuthenticatorInterface;
use chillerlan\Settings\SettingsContainerAbstract;
use chillerlan\QRCode\{QRCode, QROptionsTrait};
use chillerlan\QRCode\Data\QRMatrix;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;



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

        //VALIDA SE AINDA EXISTEM VAGAS DISPONÍVEIS PARA A ATIVIDADE
        if ($numeroInscricoesAtuais >= $numeroMaximoInscricoes) {
            return response()->json(['mensagem' => 'Número máximo de inscrições atingido para esta atividade'], 400);
        }

        //PUXA TODOS OS DADOS DA INSCRIÇÃO
        $inscricao = Inscricao::create($dados);
        $evento = Evento::find($atividade['evento_id']);

        //GERA O QR CODE BASEADO NUMA URL QUE CONTÉM O UUID DA INSCRIÇÃO
        $qrCode = 'http://localhost:8080/#/' . $inscricao->uuid->toString();
        $qrCodeValue = (new QRCode)->render($qrCode);

        //ENVIA A IMAGEM PARA O CLOUDNARY
        $imageLink = (new UploadApi())->upload($qrCodeValue)->getArrayCopy();

        //ENVIA O EMAIL
        Mail::to($inscricao->email)->send(new InscricaoCriada($inscricao, $imageLink['secure_url'], $evento, $atividade));

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
