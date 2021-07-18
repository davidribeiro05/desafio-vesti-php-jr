<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class Imagem extends Model
{
    use HasFactory;

    const PATH_IMG = 'produtos/imagens';

    protected $table = 'imagens';

    const QTD_IMAGENS_PERMITIDAS = 3;

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    /**
     * Recebe como parâmetro o ID do produto
     * @param integer $id 
     * @return boolean
     */
    public function validaImagensVinculadasAoProduto(int $id): bool
    {
        $quantidadeDeImagens =  Imagem::where('produtos_id', $id)->count('imagem');

        if ($quantidadeDeImagens >= self::QTD_IMAGENS_PERMITIDAS) {
            return false;
        }

        return true;
    }

    public function uploadImagem(FormRequest $request, $nomeImagem): bool
    {
        if (!$request->imagem->move(public_path(self::PATH_IMG), $nomeImagem)) {
            return response()->json(['mensagem' => 'Não foi possível salvar a imagem.'], 406);
        }

        return true;
    }

    public function novoNomeImagem(FormRequest $request): string
    {
        $novoNomeImagem = md5(time() . '-' . $request->imagem->getClientOriginalName()) . "." . $request->imagem->extension();
        return $novoNomeImagem;
    }

    public function removerImagem(string $nomeImagem): bool
    {
        if (!File::delete(self::PATH_IMG . "/" . $nomeImagem)) {
            return false;
        };
        
        return true;
    }
}
