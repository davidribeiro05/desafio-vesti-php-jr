<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdutoResource;
use App\Models\Produto as ProdutoModel;
use Illuminate\Http\Request;

class Produto extends Controller
{
    public function store(Request $request)
    {
        $produto = new ProdutoModel();

        $produto->nome = $request->input('nome');
        $produto->categoria = $request->input('categoria');
        $produto->preco = $request->input('preco');
        $produto->tamanho = $request->input('tamanho');
        $produto->qtd_produto = $request->input('quantidade');
        $produto->codigo = $request->input('codigo');
        $produto->composicao = $request->input('composicao');

        if (!$produto->save()) {
            return response()->json(['mensagem' => 'Falha ao salvar registro'], 404);
        }

        return response()->json(['mensagem' => 'Produto cadastrado com sucesso', 'data' => $produto], 201);
    }

    public function show(int $id)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        return new ProdutoResource(ProdutoModel::find($id));
    }

    public function update(int $id, Request $request)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $produto = ProdutoModel::find($id);

        $produto->nome = $request->input('nome', $produto->nome);
        $produto->categoria = $request->input('categoria', $produto->categoria);
        $produto->preco = $request->input('preco', $produto->preco);
        $produto->tamanho = $request->input('tamanho', $produto->tamanho);
        $produto->qtd_produto = $request->input('quantidade', $produto->qtd_produto);
        $produto->codigo = $request->input('codigo', $produto->codigo);
        $produto->composicao = $request->input('composicao', $produto->composicao);

        if (!$produto->save()) {
            return response()->json(['mensagem' => 'Falha ao editar registro'], 404);
        }

        return response()->json(['mensagem' => 'Produto editado com sucesso', 'data' => $produto], 200);
    }

    public function destroy(int $id)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        if (!ProdutoModel::destroy($id)) {
            return response()->json(['mensagem' => 'Não foi possível deletar esse produto'], 404);
        }

        return response()->json(['mensagem' => 'Produto excluido com sucesso'], 200);
    }
}
