<?php

namespace App\Http\Controllers;

use Request;

use App\DisciplinaModel;
use App\CursoModel;
use App\AtividadeModel;
use App\ConteudoModel;
use App\PesoModel;

class DisciplinaController extends Controller {

    public function listar() {

        $disciplinas = DisciplinaModel::orderBy('nome')->get();
        $cursos = CursoModel::select('id', 'nome', 'abreviatura')->get();
        $atividades = AtividadeModel::orderBy('bimestre', 'ASC')->orderBy('prazo', 'ASC')->get();
        $conteudos = ConteudoModel::orderBy('bimestre', 'ASC')->orderBy('data', 'ASC')->get();

        return view('disciplina')->with('disciplinas', $disciplinas)
            ->with('cursos', $cursos)
            ->with('atividades', $atividades)
            ->with('conteudos', $conteudos);
    }

    public function cadastrar() {

        $cursos = CursoModel::select('id', 'nome')->get();
        return view('disciplinaCadastrar')->with('cursos', $cursos);
    }

    public function editar($id) {

        $disciplina = DisciplinaModel::find($id);
        $cursos = CursoModel::select('id', 'nome')->get();
        return view('disciplinaEditar')->with('disciplina', $disciplina)
            ->with('cursos', $cursos);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            // Dados - Tabela Disciplina
            $objDisciplinaModel = new DisciplinaModel();
            $objDisciplinaModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objDisciplinaModel->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            $objDisciplinaModel->carga_horaria = Request::input('carga');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objDisciplinaModel->id_curso = $arr[0];
            // Fim
            $objDisciplinaModel->periodo = Request::input('periodo');
            $objDisciplinaModel->ativo = 1;
            $objDisciplinaModel->save();

            // Dados - Tabela Peso (iniciais - padrão)
            $objPesoModel = new PesoModel();
            $objPesoModel->id_disciplina = $objDisciplinaModel->id;
            $objPesoModel->trabalho = 0.5;
            $objPesoModel->avaliacao = 0.5;

            if(Request::input('periodo') == 'ANUAL') {
                $objPesoModel->parcial01 = $objPesoModel->parcial02 = $objPesoModel->parcial03 = $objPesoModel->parcial04 = 0.25;
            }
            else {
                $objPesoModel->parcial01 = $objPesoModel->parcial02 = $objPesoModel->parcial03 = $objPesoModel->parcial04 = 0.50;
            }

            $objPesoModel->save();
        }
        // UPDATE
        else {
            $objDisciplinaModel = DisciplinaModel::find($id);

            // Verifica se existe a disicplina com o 'id' recebido por parâmetro
            if(empty($objDisciplinaModel)) {
                return "<h2>[ERRO]: Disciplna não encontrada para o ID=".$id."!</h2>";
            }
            $objDisciplinaModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objDisciplinaModel->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            $objDisciplinaModel->carga_horaria = Request::input('carga');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objDisciplinaModel->id_curso = $arr[0];
            // Fim
            $objDisciplinaModel->periodo = Request::input('periodo');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objDisciplinaModel->ativo = 1; }
            else { $objDisciplinaModel->ativo = 0; }

            $objDisciplinaModel->save();
        }

        return redirect()->action('DisciplinaController@listar')->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $disciplina = DisciplinaModel::find($id);

            if(empty($disciplina)) {

                    $msg = "Disciplina não encontrada para o ID=$id!";

                    return view('messagebox')->with('tipo', 'alert alert-warning')
                            ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                            ->with('msg', $msg)
                            ->with('acao', "/disciplina");
            }

            $total_atv = AtividadeModel::where('id_disciplina', $id)->count();
            $total_con = ConteudoModel::where('id_disciplina', $id)->count();

            if($total_atv == 0 and $total_con == 0) {

                return view('disciplinaRemover')->with("disciplina", $disciplina);
            }
            else {

                $msg = "Existem Conteúdos e/ou Atividades vinculadas a disciplina '$disciplina->nome' que impedem sua exclusão!";

                return view('messagebox')->with('tipo', 'alert alert-danger')
                        ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                        ->with('msg', $msg)
                        ->with('acao', "/disciplina");
            }
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");
    }

    public function confirmar($id) {

        $objDisciplinaModel = DisciplinaModel::find($id);

        if(empty($objDisciplinaModel)) {

            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objPesoModel = PesoModel::where('id_disciplina', $objDisciplinaModel->id)->first();

        $objDisciplinaModel->delete();
        $objPesoModel->delete();

        return redirect()->action('DisciplinaController@listar');
    }
}
