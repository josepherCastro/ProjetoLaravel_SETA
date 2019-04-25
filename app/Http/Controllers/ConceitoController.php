<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConceitoController extends Controller {

    public function listar() {
        return view('conceito');
    }
}
