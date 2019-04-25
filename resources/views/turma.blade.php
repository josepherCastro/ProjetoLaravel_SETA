@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/turmap_ico.png') }}" >
        &nbsp;Turmas Cadastradas
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

@if (old('editar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Alterado com Sucesso!
    </div>
@endif

<div class='row'>
    <div class='col-sm-8' style="text-align: center">
        <a  href="{{ action('TurmaController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Nova Turma</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="turmas" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="turmas">
            @foreach ($turmas as $dados)
                <option value="{{ $dados->nome }}">
            @endforeach
        </datalist>
    </div>

    <div class='col-sm-1' style="text-align: center">
        <button type="button" class="btn btn-default btn-block">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </div>
</div>
<br>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME DA TURMA</th>
            <th>ANO</th>
            <th>CURSO</th>
            <th>ATIVA</th>
            <th>EVENTOS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($turmas as $dados)
        <tr>
            <td>{{ $dados->id }}</td>
            <td>{{ $dados->nome }}</td>
            <td>{{ $dados->ano }}</td>
            <td>
                @foreach($cursos as $data)
                    @if($data->id == $dados->id_curso)
                        {{ $data->nome }}
                    @endif
                @endforeach
            </td>
            <td>
                @if ($dados->ativo == 1)
                    SIM
                @else
                    NÃO
                @endif
            </td>
            <td>
                <a href="{{ action('TurmaController@editar', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                &nbsp;
                <a href="{{ action('TurmaController@remover', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-remove'></span></a>
            </td>
    @endforeach
    </tbody>
</table>

@stop
