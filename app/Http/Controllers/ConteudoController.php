<?php

namespace App\Http\Controllers;

use Request;

use App\ConteudoModel;
use App\DisciplinaModel;

class ConteudoController extends Controller {

    public function cadastrar($id) {

        $disciplina = DisciplinaModel::find($id);

        if(empty($disciplina)) {
            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        return view('conteudoCadastrar')->with('disciplina', $disciplina);
    }

    public function editar($id) {

        $conteudo = ConteudoModel::find($id);

        if(empty($conteudo)) {
            $msg = "Conteúdo não encontrado para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $disciplina = DisciplinaModel::find($conteudo->id_disciplina);

        return view('conteudoEditar')->with('conteudo', $conteudo)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objConteudoModel = new ConteudoModel();
            $objConteudoModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objConteudoModel->data = Request::input('data');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objConteudoModel->id_disciplina = $id_d;
            // Fim
            $objConteudoModel->bimestre = Request::input('bimestre');
            $objConteudoModel->ativo = 1;

            $objConteudoModel->save();
        }
        // UPDATE
        else {

            $objConteudoModel = ConteudoModel::find($id);
            $objConteudoModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objConteudoModel->data = Request::input('data');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objConteudoModel->id_disciplina = $id_d;
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objConteudoModel->ativo = 1; }
            else { $objConteudoModel->ativo = 0; }
            $objConteudoModel->bimestre = Request::input('bimestre');

            $objConteudoModel->save();
        }

        return redirect()->action('ConteudoController@cadastrar', $id_d)->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $conteudo = ConteudoModel::find($id);

            if(empty($conteudo)) {

                    $msg = "Conteúdo não encontrado para o ID=$id!";

                    return view('messagebox')->with('tipo', 'alert alert-warning')
                            ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                            ->with('msg', $msg)
                            ->with('acao', "/disciplina");
            }

            return view('conteudoRemover')->with("conteudo", $conteudo);
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");
    }

    public function confirmar($id) {

        $objConteudoModel = ConteudoModel::find($id);

        if(empty($objConteudoModel)) {

            $msg = "Conteúdo não encontrado para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objConteudoModel->delete();

        return redirect()->action('DisciplinaController@listar');

    }
}
