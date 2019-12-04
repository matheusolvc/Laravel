<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_fornecedor')->nullable();
            $table->foreign('id_fornecedor')
                ->references('id')->on('fornecedores')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_colaborador')->nullable();
            $table->foreign('id_colaborador')
                ->references('id')->on('colaboradores')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_renegociacao')->nullable();
            $table->string('codigo_barras', 100)->nullable();
            $table->char('tipo_conta', 1);
            $table->char('status', 1);
            $table->date('periodo_apuracao')->nullable();
            $table->integer('cod_imposto')->nullable();
            $table->string('cnpj_matriz', 20)->nullable();
            $table->dateTime('dt_criacao');
            $table->dateTime('dt_alteracao')->nullable();
            $table->date('dt_emissao');
            $table->date('dt_vencimento');
            $table->date('dt_pagamento')->nullable();
            $table->date('dt_recibo')->nullable();
            $table->longText('descricao')->nullable();
            $table->double('valor_documento', 9,2);
            $table->double('multa', 9,2);
            $table->double('juros', 9,2);
            $table->integer('num_doc');
            $table->integer('serie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
