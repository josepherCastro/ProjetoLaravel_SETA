<?php

namespace App\Http\Controllers;

use Request;

use App\AtividadeModel;
use App\DisciplinaModel;

class AtividadeController extends Controller {

    public function cadastrar($id) {

        $disciplina = DisciplinaModel::find($id);

        if(empty($disciplina)) {
            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        return view('atividadeCadastrar')->with('disciplina', $disciplina);
    }

    public function editar($id) {

        $atividade = AtividadeModel::find($id);

        if(empty($atividade)) {
            $msg = "Atividade não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $disciplina = DisciplinaModel::find($atividade->id_disciplina);

        return view('atividadeEditar')->with('atividade', $atividade)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objAtividadeModel = new AtividadeModel();
            $objAtividadeModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objAtividadeModel->prazo = Request::input('prazo');
            $objAtividadeModel->tipo = Request::input('tipo');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objAtividadeModel->id_disciplina = $id_d;
            // Fim
            $objAtividadeModel->bimestre = Request::input('bimestre');
            $objAtividadeModel->ativo = 1;

            $objAtividadeModel->save();
        }
        // UPDATE
        else {
            $objAtividadeModel = AtividadeModel::find($id);
            $objAtividadeModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objAtividadeModel->prazo = Request::input('prazo');
            $objAtividadeModel->tipo = Request::input('tipo');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objAtividadeModel->id_disciplina = $id_d;
            // Fim
            $objAtividadeModel->bimestre = Request::input('bimestre');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objAtividadeModel->ativo = 1; }
            else { $objAtividadeModel->ativo = 0; }

            $objAtividadeModel->save();
        }

        return redirect()->action('AtividadeController@cadastrar', $id_d)->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $atividade = AtividadeModel::find($id);

            if(empty($atividade)) {
                $msg = "Atividade não encontrada para o ID=$id!";

                return view('messagebox')->with('tipo', 'alert alert-warning')
                        ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                        ->with('msg', $msg)
                        ->with('acao', "/disciplina");
            }

            return view('atividadeRemover')->with('atividade', $atividade);
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");

    }

    public function confirmar($id) {

        $objAtividadeModel = AtividadeModel::find($id);

        if(empty($objAtividadeModel)) {

            $msg = "Atividade não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objAtividadeModel->delete();

        return redirect()->action('DisciplinaController@listar');

    }
}
