@extends('principal')

@section('script')

<script type="text/javascript">

    // Eventos da Página
    $(document).ready(function() {

        // Botão Mais - Peso Trabalho
        $("#bt_mais_bim").click(function() {
            var val = parseInt($("#it_bimestre").val());
            if(val < 4) { val = val + 1; }
            $("#it_bimestre").attr('value', val);
        });
        // Botão Menos - Peso Trabalho
        $("#bt_menos_bim").click(function() {
            var val = parseInt($("#it_bimestre").val());
            if(val > 1) { val = val - 1; }
            $("#it_bimestre").attr('value', val);
        });
    });

</script>

@stop

@section('cabecalho')
<div>
    <a href="/disciplina">
        <img src=" {{ url('/img/disciplinap_ico.png') }}" >
    </a>
        &nbsp;Alterar/Remover Conteúdo
</div>
@stop

@section('conteudo')

@if (old('editar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Aterado com Sucesso!
    </div>
@endif

<form action="{{ action('ConteudoController@salvar', $conteudo->id) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="editar" value="E">

    <div class="row">
        <div class="col-sm-10">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control" value="{{ $conteudo->nome }}">
        </div>
        <div class="col-sm-2">
            <label>Status: </label>
            <select name="ativo" class="form-control">
                @if($conteudo->ativo == 1)
                    <option selected="true">ATIVO</option>
                    <option> INATIVO</option>
                @else
                    <option>ATIVO</option>
                    <option selected="true"> INATIVO</option>
                @endif
            </select>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <label>Data: </label>
            <input type="date" name="data" class="form-control" placeholder="Data" value="{{ $conteudo->data }}">
        </div>

        <div class="col-sm-3">
            <label>Bimestre: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_bim">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="bimestre" id="it_bimestre" readonly="true" value="{{ $conteudo->bimestre }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_bim">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-6">
            <label>Disciplina: </label>
            <input type="text" name="disciplina" class="form-control" value="{{ $disciplina->id }} - {{ $disciplina->nome }}" readonly="true">
        </div>
    </div>
    <br>
    <div class='row'>
        <div class='col-sm-6' style="text-align: center">
            <button type="submit" class="btn btn-success btn-block">Salvar</button>
        </div>

        <div class='col-sm-6' style="text-align: center">
            <a href="{{ action('ConteudoController@remover', $conteudo->id) }}" class="btn btn-danger btn-block">Remover</a>
        </div>
    </div>
</form>
@stop
