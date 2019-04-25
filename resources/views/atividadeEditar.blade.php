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
        &nbsp;Editar/Remover Atividade
</div>
@stop

@section('conteudo')

<form action="{{ action('AtividadeController@salvar', $atividade->id) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="editar" value="E">

    <div class="row">
        <div class="col-sm-6">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control" value="{{ $atividade->nome }}">
        </div>

        <div class="col-sm-3">
            <label>Tipo: </label>
            <select name="tipo" class="form-control">
                @if($atividade->tipo == 'TRABALHO')
                    <option selected="true">TRABALHO</option>
                    <option>AVALIAÇÃO</option>
                @else
                    <option>TRABALHO</option>
                    <option selected="true">AVALIAÇÃO</option>
                @endif
	  		</select>
        </div>

        <div class="col-sm-3">
            <label>Status: </label>
            <select name="ativo" class="form-control">
                @if($atividade->ativo == 1)
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

        <div class="col-sm-4">
            <label>Bimestre: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_bim">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="bimestre" id="it_bimestre" readonly="true" value="{{ $atividade->bimestre }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_bim">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-4">
            <label>Prazo Etrega: </label>
            <input type="date" name="prazo" class="form-control" placeholder="Data" value="{{ $atividade->prazo }}">
        </div>

        <div class="col-sm-4">
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
            <a href="{{ action('AtividadeController@remover', $atividade->id) }}" class="btn btn-danger btn-block">Remover</a>
        </div>
    </div>
</form>
@stop
