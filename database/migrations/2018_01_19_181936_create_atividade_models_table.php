<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('atividade_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
    		$table->string('tipo');
			$table->date('prazo');
			$table->integer('id_disciplina');
            $table->integer('bimestre');
			$table->integer('ativo');
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
        Schema::dropIfExists('atividade_models');
    }
}
