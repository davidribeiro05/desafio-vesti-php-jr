<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto as ProdutoModel;
use App\Models\ProdutoHistorico;

class ProdutoController extends Controller
{
    public function index()
    {       
        return response()->json((new ProdutoModel())->produtosComImagens());
    }

    public function store(StoreProdutoRequest $request)
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

        ProdutoHistorico::gerarHistorico($produto, 'SALVAR');

        return response()->json(['mensagem' => 'Produto cadastrado com sucesso', 'data' => $produto], 201);
    }

    public function show(int $id)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        return new ProdutoResource(ProdutoModel::find($id));
    }

    public function update(int $id, UpdateProdutoRequest $request)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $produto = ProdutoModel::find($id);

        $produto->nome = $this->validaCampoVazio($request->input('nome'), $produto->nome);
        $produto->categoria = $this->validaCampoVazio($request->input('categoria'), $produto->categoria);
        $produto->preco = $this->validaCampoVazio($request->input('preco'), $produto->preco);
        $produto->tamanho = $this->validaCampoVazio($request->input('tamanho'), $produto->tamanho);
        $produto->qtd_produto = $this->validaCampoVazio($request->input('quantidade'), $produto->qtd_produto);
        $produto->codigo = $this->validaCampoVazio($request->input('codigo'), $produto->codigo);
        $produto->composicao = $this->validaCampoVazio($request->input('composicao'), $produto->composicao);

        if (!$produto->save()) {
            return response()->json(['mensagem' => 'Falha ao editar registro'], 404);
        }

        ProdutoHistorico::gerarHistorico($produto, 'EDITAR');

        return response()->json(['mensagem' => 'Produto editado com sucesso', 'data' => $produto], 200);
    }

    public function destroy(int $id)
    {
        if (!ProdutoModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $produto = ProdutoModel::find($id);

        if (!ProdutoModel::destroy($id)) {
            return response()->json(['mensagem' => 'Não foi possível deletar esse produto'], 404);
        }

        ProdutoHistorico::gerarHistorico($produto, 'EXCLUIR');

        return response()->json(['mensagem' => 'Produto excluido com sucesso'], 200);
    }

    private function validaCampoVazio($campoASerValidado, $valorASerAtribuido)
    {
        if (strlen($campoASerValidado) == 0) {
            return $valorASerAtribuido;
        }

        return $campoASerValidado;
    }
}
