<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\notificationEmail;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();

        return response()->json($eventos);
    }

    public function store(Request $request)
    {
        $evento = new Evento;

        $evento->fill($request->all());

        // $response = $this->validate_register_date($evento);
        // if ($response->getStatusCode() != 200) 
        // {
        //     return response()->json(
        //         ['message' => $response->getData()->message],
        //         $response->getStatusCode()
        //     );
        // }

        // $response = $this->validate_event_date($evento);
        // if ($response->getStatusCode() != 200) 
        // {
        //     return response()->json(
        //         ['message' => $response->getData()->message],
        //         $response->getStatusCode()
        //     );
        // }

        // $response = $this->validate_event_status($evento);
        // if ($response->getStatusCode() != 200) 
        // {
        //     return response()->json(
        //         ['message' => $response->getData()->message],
        //         $response->getStatusCode()
        //     );
        // }

        // $response = $this->validate_event_user($evento);
        // if ($response->getStatusCode() != 200) 
        // {
        //     return response()->json(
        //         ['message' => $response->getData()->message],
        //         $response->getStatusCode()
        //     );
        // }

        $evento->save();

        return response()->json($evento);
    }

    public function show($id)
    {
        $evento = DB::table('evento')
            ->where('evento.id', $id)
            ->first();

        return response()->json($evento);
        
    }
        

    public function showAll()
    {
        $eventos = Evento::all();

        return response()->json($eventos);
    }


    public function showSolicited()
    {
        $eventos = Evento::where('situacao', 'Em Aprovação')->get();

        if ($eventos->isEmpty()) 
        {
            return response()->json(['error' => 'Nenhum evento encontrado.'], 404);
        }

        return view('eventos.index', compact('eventos'));
    }

    public function showActive()
    {
        $eventos = Evento::where('situacao', 'Aprovado')->get();

        if ($eventos->isEmpty()) 
        {
            return response()->json(['error' => 'Nenhum evento encontrado.'], 404);
        }

        return view('eventos.index', compact('eventos'));
    }

    public function showByUser($user_id)
    {
        $eventos = Evento::where('created_by_user', $user_id)->get();

        if ($eventos->isEmpty()) 
        {
            return response()->json(['error' => 'Nenhum evento encontrado.'], 404);
        }

        return view('eventos.index', compact('eventos'));
    }

    public function showActiveByUser($user_id)
    {
        $eventos = Evento::where('created_by_user', $user_id)
            ->where('situacao', 'Aprovado')
            ->get();

        if ($eventos->isEmpty()) {
            return response()->json(['error' => 'Nenhum evento encontrado.'], 404);
        }

        return view('eventos.index', compact('eventos'));
    }

    public function update(Request $request, $id)
    {
        $disallowedAttributes = [
            'created_by_user',
            'created_at',
        ];

        $evento = Evento::findOrFail($id);

        $disallowedAttributesPresent = array_intersect(array_keys($request->all()), $disallowedAttributes);
        if (!empty($disallowedAttributesPresent)) 
        {
            return response()->json(['message' => 'Os atributos created_by_user e created_at não podem ser modificados'], 400);
        }

        $evento->update($request->all());

        return response()->json($evento);
    }


    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
    
        $evento->delete();
    
        return response()->json(['message' => 'Evento removido com sucesso']);
    }    

    public function validate_register_date(Evento $evento)
    {
        $data_registro = strtotime($evento->created_at);        

        if(!$data_registro  )
        {
            return response()->json(['message' =>$evento], 400);
        }
        else 
            return response()->json(['message' => 'ok'], 200);
 
    }

    public function validate_event_date(Evento $evento)
    {
        $data_inicial = strtotime($evento->data_inicial);
        $data_final = strtotime($evento->data_final);

        if($data_inicial == Null || $data_final == Null)
        {
            return response()->json(['message' => 'Datas do evento vazias'], 400);
        }

        else if($data_inicial <= $data_final)
        {
            return response()->json(['message' => 'Datas do evento corretas'], 200);
        }

        else
        {
            return response()->json(['message' => 'Data inicial maior do que data final'], 400);
        }
    }

    public function validate_event_status(Evento $evento)
    {
        if ($evento->situacao != 'Em Aprovação')
        {
            return response()->json(['message' => 'Evento precisa ser cadastrado com status "Em Aprovação" para passar por análise'], 400);
        }

        return response()->json(['message' => 'Status de cadastro do evento correto'], 200);
    }

    public function validate_event_user(Evento $evento)
    {
        $user = User::find($evento->created_by_user);

        if ((bool)$user->membro_ufms !== true) 
        {
            return response()->json(['message' => 'Usuário não tem permissões para cadastrar evento'], 400);
        }

        return response()->json(['message' => 'Usuário tem permissões para cadastrar evento'], 200);
    }

    public function validate_event_user_approve(Evento $evento)
    { 
        $user = User::find($evento->created_by_user);

        if ((bool)$user->administrador !== true) 
        {
            return response()->json(['message' => 'Usuário não tem permissões para aprovar evento'], 400);
        }

        return response()->json(['message' => 'Usuário tem permissões para aprovar evento'], 200);
    }
    public function sendEmailOnUpdate($evento){
        $sendToEmail = Auth::user();

        Mail::to($sendToEmail)->send(new notificationEmail($evento));
    }

    public function create(Request $request)
    {
        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'nome'              => 'required|string|max:255',
            'descricao'         => 'required|string',
            'local'             => 'required|string|max:255',
            'id_categoria'      => 'required|integer',
            'id_tipo'           => 'required|integer',
            'data_inicial'      => 'required|date',
            'data_final'        => 'required|date|after_or_equal:data_inicial',
            'hora_inicial'      => 'required|date',
            'hora_final'        => 'required|date|after_or_equal:hora_inicial',
            'created_by_user'   => 'integer',
            'situacao'          => 'required|in:Em Aprovação,Aprovado,Rejeitado',
            'imagem'            => 'image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Falha na validação', 'errors' => $validator->errors()], 400);
        }
    
        // Verifique se um arquivo de imagem foi enviado
        if ($request->hasFile('imagem')) {
            // Obtenha o arquivo da imagem do request
            $imagem = $request->file('imagem');
    
            // Salve a imagem em algum local (por exemplo, na pasta de uploads)
            $caminhoImagem = $imagem->store('uploads'); // Você pode personalizar o local de armazenamento conforme necessário
    
            // Defina o caminho da imagem no modelo de Evento
            $evento->imagem = $caminhoImagem;
        }
    
        // Criação do evento
        $evento = new Evento;
        $evento->fill($request->all());
    
        // Salva o evento
        $evento->save();
    
        return response()->json(['message' => 'Evento criado com sucesso', 'evento' => $evento], 201);
    }
    
    public function eventosPaginaInicial() {
        // Obter os 12 primeiros eventos cadastrados
        $eventos = Evento::orderBy('created_at', 'desc')->take(12)->get();

        // Dividir os eventos em dois arrays
        $eventosDestaque = $eventos->take(4);
        $maisEventos = $eventos->slice(4);

        // Retornar os dados no formato desejado (por exemplo, em JSON)
        return response()->json([
            'eventosDestaque' => $eventosDestaque,
            'maisEventos' => $maisEventos,
        ]);
    }
    
}