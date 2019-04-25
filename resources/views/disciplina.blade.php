@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/disciplinap_ico.png') }}" >
        &nbsp;Disciplinas Cadastradas
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

<div class='row'>
    <div class='col-sm-8' style="text-align: center">
        <a  href="{{ action('DisciplinaController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Nova Disciplina</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="disciplinas" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="disciplinas">
            @foreach ($disciplinas as $dados)
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
<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME DA DISCIPLINA</th>
                <!-- <th>ABREVIATURA</th> -->
                <th>CURSO</th>
                <th>CARGA</th>
                <th>PERÍODO</th>
                <th>CONTEÚDOS</th>
                <th>ATIVIDADES</th>
                <th>ATIVO</th>
                <th>EVENTOS</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($disciplinas as $dados)
            <tr>
                <td>{{ $dados->id }}</td>
                <td>{{ $dados->nome }}</td>
                <!-- <td>{{ $dados->abreviatura }}</td> -->
                <td>
                    @foreach($cursos as $data)
                        @if($data->id == $dados->id_curso)
                            {{ $data->abreviatura }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $dados->carga_horaria }} H/A</td>
                <td>{{ $dados->periodo }}</td>

                <td>
                    <div class="btn-group">
                        <a  href="{{ action('ConteudoController@cadastrar', $dados->id) }}" type="button" class="btn btn-primary">
                            <span class='glyphicon glyphicon-plus'></span>
                        </a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @php ($flag = 1)
                            @foreach($conteudos as $data)
                                @if($data->id_disciplina == $dados->id)

                                    @if($data->bimestre == 1 and $flag == 1)
                                        <li class="dropdown-header">1º Bimestre</li>
                                        @php ($flag = 2)
                                    @elseif ($data->bimestre == 2 and $flag == 2)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">2º Bimestre</li>
                                        @php ($flag = 3)
                                    @elseif ($data->bimestre == 3 and $flag == 3)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">3º Bimestre</li>
                                        @php ($flag = 4)
                                    @elseif ($data->bimestre == 4 and $flag == 4)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">4º Bimestre</li>
                                        @php ($flag = 0)
                                    @endif

                                    <li>
                                        <a href="{{ action('ConteudoController@editar', $data->id) }}">
                                            @if($data->ativo == 1)
                                                <i>{{ \Carbon\Carbon::parse($data->data)->format('d/m/Y') }}</i> - {{ $data->nome }} - (ATIVO)
                                            @else
                                                <i>{{ \Carbon\Carbon::parse($data->data)->format('d/m/Y') }}</i> - {{ $data->nome }} - (INATIVO)
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </td>

                <td>
                    <div class="btn-group">
                        <a  href="{{ action('AtividadeController@cadastrar', $dados->id) }}" type="button" class="btn btn-primary">
                            <span class='glyphicon glyphicon-plus'></span>
                        </a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @php ($flag = 1)
                            @foreach($atividades as $data)
                                @if($data->id_disciplina == $dados->id)

                                    @if($data->bimestre == 1 and $flag == 1)
                                        <li class="dropdown-header">1º Bimestre</li>
                                        @php ($flag = 2)
                                    @elseif ($data->bimestre == 2 and $flag == 2)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">2º Bimestre</li>
                                        @php ($flag = 3)
                                    @elseif ($data->bimestre == 3 and $flag == 3)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">3º Bimestre</li>
                                        @php ($flag = 4)
                                    @elseif ($data->bimestre == 4 and $flag == 4)
                                        <li class="divider"></li>
                                        <li class="dropdown-header">4º Bimestre</li>
                                        @php ($flag = 0)
                                    @endif

                                    <li>
                                        <a href="{{ action('AtividadeController@editar', $data->id) }}">
                                            @if($data->ativo == 1)
                                                <i>{{ \Carbon\Carbon::parse($data->prazo)->format('d/m/Y') }}</i> - {{ $data->nome }} (ATIVO)
                                            @else
                                                <i>{{ \Carbon\Carbon::parse($data->prazo)->format('d/m/Y') }}</i> - {{ $data->nome }} (INATIVO)
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </td>

                <td>
                    @if ($dados->ativo == 1)
                        SIM
                    @else
                        NÃO
                    @endif
                </td>
                <td>
                    <a href="{{ action('DisciplinaController@editar', $dados->id) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                    &nbsp;
                    <a href="{{ action('DisciplinaController@remover', $dados->id) }}"><span class='glyphicon glyphicon-remove'></span></a>
                    &nbsp;
                    <a href="{{ action('PesoController@editar', $dados->id) }}"><span class='glyphicon glyphicon-education'></span></a>
                </td>
        @endforeach
        </tbody>
    </table>
</div>
@stop
