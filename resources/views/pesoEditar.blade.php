@extends('principal')

@section('cabecalho')
<div>
    <a href="/disciplina">
        <img src=" {{ url('/img/disciplinap_ico.png') }}" >
    </a>
        &nbsp;Editar Peso: Trabalho / Avaliação / Parcial
</div>
@stop

@section('script')

<script type="text/javascript">

    // Eventos da Página
    $(document).ready(function() {

        // Botão Mais - Peso Trabalho
        $("#bt_mais_trab").click(function() {
            var val = parseFloat($("#it_trabalho").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_trabalho").attr('value', val.toFixed(2));
        });
        // Botão Menos - Peso Trabalho
        $("#bt_menos_trab").click(function() {
            var val = parseFloat($("#it_trabalho").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_trabalho").attr('value', val.toFixed(2));
        });

        // Botão Mais - Peso Avaliação
        $("#bt_mais_ava").click(function() {
            var val = parseFloat($("#it_avaliacao").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_avaliacao").attr('value', val.toFixed(2));
        });
        // Botão Menos - Peso Avaliação
        $("#bt_menos_ava").click(function() {
            var val = parseFloat($("#it_avaliacao").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_avaliacao").attr('value', val.toFixed(2));
        });

        // Botão Mais - 1ª Parcial
        $("#bt_mais_p01").click(function() {
            var val = parseFloat($("#it_p01").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_p01").attr('value', val.toFixed(2));
        });
        // Botão Menos - 1ª Parcial
        $("#bt_menos_p01").click(function() {
            var val = parseFloat($("#it_p01").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_p01").attr('value', val.toFixed(2));
        });

        // Botão Mais - 2ª Parcial
        $("#bt_mais_p02").click(function() {
            var val = parseFloat($("#it_p02").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_p02").attr('value', val.toFixed(2));
        });
        // Botão Menos - 2ª Parcial
        $("#bt_menos_p02").click(function() {
            var val = parseFloat($("#it_p02").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_p02").attr('value', val.toFixed(2));
        });

        // Botão Mais - 3ª Parcial
        $("#bt_mais_p03").click(function() {
            var val = parseFloat($("#it_p03").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_p03").attr('value', val.toFixed(2));
        });
        // Botão Menos - 3ª Parcial
        $("#bt_menos_p03").click(function() {
            var val = parseFloat($("#it_p03").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_p03").attr('value', val.toFixed(2));
        });

        // Botão Mais - 4ª Parcial
        $("#bt_mais_p04").click(function() {
            var val = parseFloat($("#it_p04").val());
            if(val < 1) { val = val + 0.05; }
            $("#it_p04").attr('value', val.toFixed(2));
        });
        // Botão Menos - 4ª Parcial
        $("#bt_menos_p04").click(function() {
            var val = parseFloat($("#it_p04").val());
            if(val > 0) { val = val - 0.05; }
            $("#it_p04").attr('value', val.toFixed(2));
        });
    });

</script>

@stop

@section('conteudo')

@if (old('editar'))
    <div class="alert alert-success">
        <strong> Pesos da disciplina {{ old('nome') }} </strong>: Aterado com Sucesso!
    </div>
@endif

<form action="{{ action('PesoController@salvar', $peso->id) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="editar" value="E">

    <div class="row">
        <div class="col-sm-6">
            <label>Disciplina: </label>
            <input type="text" name="nome" class="form-control" value="{{ $disciplina->nome }}" readonly="true">
        </div>
        <div class="col-sm-3">
            <label>Trabalho: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_trab">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="trabalho" id="it_trabalho" readonly="true" value="{{ $peso->trabalho }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_trab">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>
        <div class="col-sm-3">
            <label>Avaliação: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_ava">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="avaliacao" id="it_avaliacao" readonly="true" value="{{ $peso->avaliacao }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_ava">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <label>1ª Parcial: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_p01">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="parcial01" id="it_p01" readonly="true" value="{{ $peso->parcial01 }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_p01">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-3">
            <label>2ª Parcial: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_p02">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="parcial02" id="it_p02" readonly="true" value="{{ $peso->parcial02 }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_p02">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-3">
            <label>3ª Parcial: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_p03">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="parcial03" id="it_p03" readonly="true" value="{{ $peso->parcial03 }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_p03">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-3">
            <label>4ª Parcial: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos_p04">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="parcial04" id="it_p04" readonly="true" value="{{ $peso->parcial04 }}">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais_p04">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block">Salvar</button>
</form>
@stop
