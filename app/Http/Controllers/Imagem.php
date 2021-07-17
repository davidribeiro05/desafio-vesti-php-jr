<?php

namespace App\Http\Controllers;

use App\Models\Imagem as ImagemModel;
use Illuminate\Http\Request;

class Imagem extends Controller
{
    public function store(Request $request)
    {
        $imagem = new ImagemModel();
        $imagem->imagem = $request->input('imagem');
        $imagem->produtos_id = $request->input('produtos_id');

        if (!$imagem->validaImagensVinculadasAoProduto($request->input('produtos_id'))) {
            return response()->json(
                ['mensagem' => 'Não é foi possível inserir imagem pois o limite máximo de imagens vinculadas a este produto já foi atingido'],
                406
            );
        }

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

        $imagem = ImagemModel::find($id);

        $imagem->imagem = $request->input('imagem', $imagem->imagem);

        if (!$imagem->save()) {
            return response()->json(['mensagem' => 'Falha ao editar imagem'], 404);
        }

        return response()->json(['mensagem' => 'Imagem editada com sucesso', 'data' => $imagem], 200);
    }

    public function destroy(int $id)
    {
        if (!ImagemModel::find($id)) {
            return response()->json(['mensagem' => 'Não existe registro com esse ID'], 404);
        }

        if (!ImagemModel::destroy($id)) {
            return response()->json(['mensagem' => 'Não foi possível deletar essa imagem'], 404);
        }

        return response()->json(['mensagem' => 'Imagem excluida com sucesso'], 200);
    }
}
