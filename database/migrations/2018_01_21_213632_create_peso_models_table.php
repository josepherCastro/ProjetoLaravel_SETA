<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesoModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('peso_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_disciplina');
            $table->double('trabalho', 3, 2);
            $table->double('avaliacao', 3, 2);
            $table->double('parcial01', 3, 2);
            $table->double('parcial02', 3, 2);
            $table->double('parcial03', 3, 2);
            $table->double('parcial04', 3, 2);
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
        Schema::dropIfExists('peso_models');
    }
}
