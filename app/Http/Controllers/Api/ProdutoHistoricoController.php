<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProdutoHistorico;
use Illuminate\Http\Request;


class ProdutoHistoricoController extends Controller
{
    public function index()
    {
        return response()->json(ProdutoHistorico::all());
    }

    public function show(int $id)
    {
        if (!ProdutoHistorico::where('id_produto', $id)->get()) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 200);
        }

        return response()->json(ProdutoHistorico::where('id_produto', $id)->orderByDesc('id')->get(), 200);
    }
}
