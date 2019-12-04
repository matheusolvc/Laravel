<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenegociacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renegociacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_conta');
            $table->foreign('id_conta')
                ->references('id')->on('contas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->char('status');
            $table->dateTime('dt_solicitacao');
            $table->char('tipo_renegociacao');
            $table->integer('qtde_parcelas');
            $table->date('dt_vencimento');
            $table->double('valor_novo', 9,2);
            $table->longText('observacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renegociacoes');
    }
}
