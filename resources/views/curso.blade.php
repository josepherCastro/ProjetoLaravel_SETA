@extends('principal')

@section('cabecalho')
<div>
        <img src=" {{ url('/img/cursop_ico.png') }}" >
        &nbsp;Cursos Cadastrados
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
        <a  href="{{ action('CursoController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo Curso</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="cursos" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="cursos">
            @foreach ($cursos as $dados)
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
            <th>NOME DO CURSO</th>
            <th>ABREVIATURA</th>
            <th>NIVEL</th>
            <th>TEMPO</th>
            <th>ATIVO</th>
            <th>EVENTOS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($cursos as $dados)
        <tr>
            <td>{{ $dados->id }}</td>
            <td>{{ $dados->nome }}</td>
            <td>{{ $dados->abreviatura }}</td>
            <td>
                @foreach($niveis as $data)
                    @if($data->id == $dados->id_nivel)
                        {{ $data->abreviatura }}
                    @endif
                @endforeach
            </td>
            <td>{{ $dados->tempo }} ano(s)</td>
            <td>
                @if ($dados->ativo == 1)
                    SIM
                @else
                    NÃO
                @endif
            </td>
            <td>
                <a href="{{ action('CursoController@editar', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                &nbsp;
                <a href="{{ action('CursoController@remover', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-remove'></span></a>
            </td>

    @endforeach
    </tbody>
</table>

@stop
