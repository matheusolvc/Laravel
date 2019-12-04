<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_conta');
            $table->foreign('id_conta')
                ->references('id')->on('contas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->date('dt_geracao');
            $table->date('dt_alteracao');
            $table->double('valor_lote', 9,2);
            $table->char('status', 1);
            $table->dateTime('dt_transmissao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
