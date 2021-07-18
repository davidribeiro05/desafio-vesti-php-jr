<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Imagem\StoreImagemRequest;
use App\Http\Requests\Imagem\UpdateImagemRequest;
use App\Models\Imagem as ImagemModel;

class Imagem extends Controller 
{
    public function index()
    {       
        return response()->json(ImagemModel::all());
    }

    public function store(StoreImagemRequest $request)
    {
        $imagem = new ImagemModel();

        if (!$imagem->validaImagensVinculadasAoProduto($request->input('produtos_id'))) {
            return response()->json(
                ['mensagem' => 'Limite máximo de imagens vinculadas a este produto já foi atingido'],
                406
            );
        }

        $novoNomeImagem = $imagem->novoNomeImagem($request);
        $imagem->uploadImagem($request, $novoNomeImagem);

        $imagem->imagem = $novoNomeImagem;
        $imagem->produtos_id = $request->input('produtos_id');

        if (!$imagem->save()) {
            return response()->json(['mensagem' => 'Falha ao salvar imagem'], 404);
        }

        return response()->json(['mensagem' => 'Imagem salva com sucesso', 'data' => $imagem], 201);
    }

    public function show(int $id)
    {
        if (!ImagemModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        return response()->json(['data' => ImagemModel::find($id)], 200);
    }

    public function update(int $id, UpdateImagemRequest $request)
    {
        $imagemModel = new ImagemModel();

        if (!ImagemModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $imagemAntiga = ImagemModel::find($id);
        $imagemNova = ImagemModel::find($id);

        $novoNomeImagem = $imagemModel->novoNomeImagem($request);
        $imagemModel->uploadImagem($request, $novoNomeImagem);

        $imagemNova->imagem = $novoNomeImagem;

        if (!$imagemNova->save()) {
            return response()->json(['mensagem' => 'Falha ao editar imagem'], 404);
        }

        $imagemModel->removerImagem($imagemAntiga->imagem);

        return response()->json(['mensagem' => 'Imagem editada com sucesso', 'data' => $imagemNova], 200);
    }

    public function destroy(int $id)
    {
        if (!ImagemModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $imagem = ImagemModel::find($id);

        if (!ImagemModel::destroy($id)) {
            return response()->json(['mensagem' => 'Não foi possível deletar essa imagem'], 404);
        }

        (new ImagemModel())->removerImagem($imagem->imagem);

        return response()->json(['mensagem' => 'Imagem excluida com sucesso'], 200);
    }
}
