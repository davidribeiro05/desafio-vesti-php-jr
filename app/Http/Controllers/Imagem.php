<?php

namespace App\Http\Controllers;

use App\Http\Requests\Imagem\StoreImagemRequest;
use App\Http\Requests\Imagem\UpdateImagemRequest;
use App\Models\Imagem as ImagemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Imagem extends Controller
{
    const PATH_IMG = 'produtos/imagens';

    public function store(StoreImagemRequest $request)
    {
        $imagem = new ImagemModel();

        if (!$imagem->validaImagensVinculadasAoProduto($request->input('produtos_id'))) {
            return response()->json(
                ['mensagem' => 'Limite máximo de imagens vinculadas a este produto já foi atingido'],
                406
            );
        }

        $novoNomeImagem = md5(time() . '-' . $request->imagem->getClientOriginalName()) . "." . $request->imagem->extension();

        if (!$request->imagem->move(public_path(self::PATH_IMG), $novoNomeImagem)) {
            return response()->json(['mensagem' => 'Não foi possível salvar a imagem.'], 406);
        }

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

    public function update(int $id, Request $request)
    {
        if (!ImagemModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        $imagemAntiga = ImagemModel::find($id);
        $imagemNova = ImagemModel::find($id);

        $novoNomeImagem = md5(time() . '-' . $request->imagem->getClientOriginalName()) . "." . $request->imagem->extension();

        if (!$request->imagem->move(public_path(self::PATH_IMG), $novoNomeImagem)) {
            return response()->json(['mensagem' => 'Não foi possível salvar a imagem.'], 406);
        }

        $imagemNova->imagem = $novoNomeImagem;

        if (!$imagemNova->save()) {
            return response()->json(['mensagem' => 'Falha ao editar imagem'], 404);
        }

        File::delete(self::PATH_IMG . "/" . $imagemAntiga->imagem);

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

        File::delete(self::PATH_IMG . "/" . $imagem->imagem);

        return response()->json(['mensagem' => 'Imagem excluida com sucesso'], 200);
    }
}
