<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?, ?)', 
        array('Superior Tecnologo', 'SUP-Tec'));
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?, ?)', 
        array('Superior Baicharel', 'SUP-Bel'));
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?, ?)', 
        array('Superior Licenciatura', 'SUP-Lic'));
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?, ?)', 
        array('Medio', 'ME'));
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?, ?)', 
        array('Medio Integrado Tecnico', 'MIE-Tec'));
    }
}
