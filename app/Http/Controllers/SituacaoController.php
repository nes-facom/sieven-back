<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    public function index()
    {
        $situacao = Situacao::all();
        

        return response()->json($situacao);
    }

    public function store(Request $request)
    {
        $situacao = new Situacao;

        $situacao->fill($request->all());

        $situacao->save();

        return response()->json($situacao);
    }

    public function show($id)
    {
        $situacao = Situacao::find($id);


        return response()->json($situacao);
    }

    public function update(Request $request, $id)
    {
        $situacao = Situacao::findOrFail($id);

        $situacao->fill($request->all());

        $situacao->save();

        return response()->json($situacao);
    }

    public function destroy($id)
    {
        $situacao = Situacao::findOrFail($id);

        $situacao->delete();

        return response()->json(['message' => 'Situação removida com sucesso']);
    }
}
