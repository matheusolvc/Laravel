<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetornoLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retorno_lotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_lote');
            $table->foreign('id_lote')
                ->references('id')->on('lotes')
                ->onDelete('cascade');
            $table->char('status', 1);
            $table->string('mensagem', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retorno_lotes');
    }
}
