<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use App\TurmaModel;
use App\CursoModel;

class TurmaController extends Controller {

    public function listar() {

        // $cursos = DB::select('SELECT * FROM turma_models');
        $turmas = TurmaModel::orderBy('nome')->get();
        $cursos = CursoModel::select('id', 'nome')->get();
        return view('turma')->with('turmas', $turmas)->with('cursos', $cursos);
    }

    public function cadastrar() {

        $cursos = CursoModel::orderBy('id')->get();
        $hoje = getdate();
        return view('turmaCadastrar')->with('cursos', $cursos)->with('data_ano', $hoje['year']);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objTurmaModel = new TurmaModel();
            $objTurmaModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objTurmaModel->ano = Request::input('ano');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objTurmaModel->id_curso = $arr[0];
            // Fim
            $objTurmaModel->ativo = 1;

            $objTurmaModel->save();
        }
        // UPDATE
        else {
            $objTurmaModel = TurmaModel::find($id);
            $objTurmaModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objTurmaModel->ano = Request::input('ano');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objTurmaModel->id_curso = $arr[0];
            // Fim
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objTurmaModel->ativo = 1; }
            else { $objTurmaModel->ativo = 0; }

            $objTurmaModel->save();
        }

        return redirect()->action('TurmaController@listar')->withInput();
    }

    public function editar($id) {

        // Filtra parâmetro para garantir que é um número
        if(is_numeric($id)) {

            $turma = TurmaModel::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($turma)) {
                return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
            }

            $cursos = CursoModel::orderBy('id')->get();
            return view('turmaEditar')->with('turma', $turma)->with('cursos', $cursos);
        }
        else {
            return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
        }

    }

    public function remover($id) {

        if(is_numeric($id)) {

            $turma = TurmaModel::find($id);

            if(empty($turma)) {
                    return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
            }

            return view('turmaRemover')->with("turma", $turma);
        }

        return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
    }

    public function confirmar($id) {

        $objTurmaModel = TurmaModel::find($id);

        if(empty($objTurmaModel)) {
                return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
        }

        $objTurmaModel->delete();

        return redirect()->action('TurmaController@listar');
    }
}
