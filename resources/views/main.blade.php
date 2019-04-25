@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/homep_ico.png') }}" >
        &nbsp;Menu Principal
</div>
@stop

@section('conteudo')
<div class='row'>

    <div class='col-sm-3' style="text-align: center">
        <a href="/curso">
            <img src="{{ url('/img/curso_ico.png') }}">
        </a>
        <h3> Curso </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/turma">
            <img src="{{ url('/img/turma_ico.png') }}">
        </a>
        <h3> Turma </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/aluno">
            <img src="{{ url('/img/aluno_ico.png') }}">
        </a>
        <h3> Aluno </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/disciplina">
            <img src="{{ url('/img/disciplina_ico.png') }}">
        </a>
        <h3> Disciplina </h3>
    </div>
</div>
<br>
<div class='row'>
    <div class='col-sm-3' style="text-align: center">
        <a href="/conceito">
            <img src="{{ url('/img/conceito_ico.png') }}">
        </a>
        <h3> Conceito </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/relatorio">
            <img src="{{ url('/img/relatorio_ico.png') }}">
        </a>
        <h3> Relatório </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/importar">
            <img src="{{ url('/img/importar_ico.png') }}">
        </a>
        <h3> Importar </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/exportar">
            <img src="{{ url('/img/exportar_ico.png') }}">
        </a>
        <h3> Exportar </h3>
    </div>

</div>

@stop
