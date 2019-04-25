<?php

namespace App\Http\Controllers;

use Request;

use App\PesoModel;
use App\DisciplinaModel;

class PesoController extends Controller {

    public function editar($id) {

        $disciplina = DisciplinaModel::find($id);

        if(empty($disciplina)) {

            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $peso = PesoModel::where('id_disciplina', $id)->first();

        return view('pesoEditar')->with('peso', $peso)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        $objPesoModel = PesoModel::find($id);

        $objPesoModel->trabalho = Request::input('trabalho');
        $objPesoModel->avaliacao = Request::input('avaliacao');
        $objPesoModel->parcial01 = Request::input('parcial01');
        $objPesoModel->parcial02 = Request::input('parcial02');
        $objPesoModel->parcial03 = Request::input('parcial03');
        $objPesoModel->parcial04 = Request::input('parcial04');

        $objPesoModel->save();

        return redirect()->action('PesoController@editar', $objPesoModel->id_disciplina)->withInput();
    }
}
