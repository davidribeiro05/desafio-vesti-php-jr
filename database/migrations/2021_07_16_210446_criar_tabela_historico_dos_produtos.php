<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaHistoricoDosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 255);
            $table->string('categoria', 255);
            $table->string('nome', 255);
            $table->decimal('preco', $precision = 15, $scale = 2);
            $table->text('composicao');
            $table->string('tamanho', 100);
            $table->integer('qtd_produto');
            $table->string('acao', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_produtos');
    }
}
