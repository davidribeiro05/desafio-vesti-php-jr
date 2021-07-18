<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    public function imagens()
    {
        return $this->hasMany(Imagem::class, 'produtos_id', 'id');
    }

    public function produtosComImagens()
    {
        $produtos = Produto::all();
        $produtosComImagens = [];
        foreach ($produtos as $produto) {
            $produto->imagem = Produto::find($produto->id)->imagens->toArray();
            $produtosComImagens[] = $produto;
        }
        return $produtosComImagens;
    }
}
