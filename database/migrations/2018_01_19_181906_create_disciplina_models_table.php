<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('disciplina_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
    		$table->string('abreviatura');
			$table->integer('carga_horaria');
			$table->integer('id_curso');
			$table->string('periodo');
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
        Schema::dropIfExists('disciplina_models');
    }
}
