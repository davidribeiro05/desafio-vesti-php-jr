<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;

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
    protected function validaImagensVinculadasAoProduto(int $id): bool
    {
        $quantidadeDeImagens =  Imagem::where('produtos_id', $id)->count('imagem');

        if ($quantidadeDeImagens >= self::QTD_IMAGENS_PERMITIDAS) {
            return false;
        }

        return true;
    }
}
