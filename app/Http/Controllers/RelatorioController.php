<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller {

    public function listar() {
        return view('relatorio');
    }
}
