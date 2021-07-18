<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoHistorico extends Model
{
    use HasFactory;

    protected $table = 'historico_produtos';

    public static function gerarHistorico(Produto $produto, string $acao)
    {
        $produtoHistorico = new ProdutoHistorico();

        $produtoHistorico->nome = $produto->nome;
        $produtoHistorico->categoria = $produto->categoria;
        $produtoHistorico->preco = $produto->preco;
        $produtoHistorico->tamanho = $produto->tamanho;
        $produtoHistorico->qtd_produto = $produto->qtd_produto;
        $produtoHistorico->codigo = $produto->codigo;
        $produtoHistorico->composicao = $produto->composicao;
        $produtoHistorico->acao = $acao;
        $produtoHistorico->id_produto = $produto->id;
        $produtoHistorico->save();
    }
}
