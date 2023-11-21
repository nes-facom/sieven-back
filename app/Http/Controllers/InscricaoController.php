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
use chillerlan\QRCode\QROptions;
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

        //Consulta o banco para saber o número de inscrições
        $numeroInscricoesAtuais = Inscricao::where('atividade_id', $dados['atividade_id'])->count();

        //Consulta o banco para saber se já existe outra inscrição com o mesmo CPF
        $inscricaoExistente = Inscricao::where('atividade_id', $dados['atividade_id'])
            ->where('cpf', $dados['cpf'])
            ->first();

        //Faz a validação das consultas acima
        if ($numeroInscricoesAtuais >= $numeroMaximoInscricoes) {
            return response()->json(['mensagem' => 'Número máximo de inscrições atingido para esta atividade'], 400);
        } else if ($inscricaoExistente) {
            return response()->json(['mensagem' => 'Já existe uma inscrição para esta atividade com o mesmo CPF'], 401);
        }

        //Cria a inscrição no banco
        $inscricao = Inscricao::create($dados);
        $evento = Evento::find($atividade['evento_id']);

        //Gera o QR Code baseado em uma URL que contém o uuid da inscrição
        $qrCode = '/inscricao' . '/'. $inscricao->uuid->toString();

        //Seta o background para a cor branca para evitar problemas com dark-mode
        $options = new QROptions([
            'imageTransparent'    => false
        ]);
        $qrCodeValue = (new QRCode($options))->render($qrCode);

        //Envia a mensagem para o Cloudnary
        $imageLink = (new UploadApi())->upload($qrCodeValue)->getArrayCopy();

        //Envia o e-mail
        Mail::to($inscricao->email)->send(new InscricaoCriada($inscricao, $imageLink['secure_url'], $evento, $atividade));

        return response()->json(['mensagem' => 'Inscrição criada com sucesso', 'inscricao' => $inscricao], 200);
    }

    public function update($uuid)
    {
        // Encontrar a inscrição com base no UUID
        $inscricao = Inscricao::where('uuid', $uuid)->first();

        if (!$inscricao) {
            return response()->json(['mensagem' => 'Inscrição não encontrada', 'status' => 404], 404);
        }

        // Verificar se a inscrição já fez check-in
        if ($inscricao->checkin) {
            return response()->json(['mensagem' => 'Esta inscrição já fez check-in', 'status' => 400], 400);
        }

        // Alterar o atributo checkin para true
        $inscricao->update(['checkin' => true]);

        return response()->json(['mensagem' => 'Check-in realizado com sucesso'], 200);
    }

    public function show($id)
    {
        // Lógica para mostrar um recurso específico
    }

    public function edit($id)
    {
        // Lógica para exibir o formulário de edição
    }

    // public function update(Request $request, $id)
    // {
    //     // Lógica para atualizar um recurso no banco de dados
    // }

    public function destroy($id)
    {
        // Lógica para excluir um recurso do banco de dados
    }
}
