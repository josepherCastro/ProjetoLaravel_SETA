@extends('principal')

@section('script')

<script type="text/javascript">

    // Eventos da Página
    $(document).ready(function() {

        // Botão Mais Carga Horária
        $("#bt_mais").click(function() {

            var val = parseInt($("#it_carga").val());

            if(val < 200) {
                val = val + 5;
            }

            $("#it_carga").attr('value', val);

        });

        // Botão Menos Carga Horária
        $("#bt_menos").click(function() {

            var val = parseInt($("#it_carga").val());

            if(val > 10) {
                val = val - 5;
            }

            $("#it_carga").attr('value', val);
        });
    });

</script>

@stop

@section('cabecalho')
<div>
        <a href="/disciplina">
            <img src=" {{ url('/img/disciplinap_ico.png') }}" >
        </a>
        &nbsp;Cadastrar Nova Disciplina
</div>
@stop

@section('conteudo')

<form action="{{ action('DisciplinaController@salvar', ['id' => 0]) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="cadastrar" value="C">

    <div class="row">
        <div class="col-sm-10">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="col-sm-2">
            <label>Abreviatura: </label>
            <input type="text" name="abreviatura" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <label>Curso: </label>
            <select name="curso" class="form-control">
                <option disabled="true" selected="true"> </option>
	  			@foreach ($cursos as $dados)
                    <option> {{ $dados->id }} - {{ $dados->nome }} </option>
                @endforeach
	  		</select>
        </div>

        <div class="col-sm-3">
            <label>Carga (horas/aula): </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="carga" id="it_carga" readonly="true" value="60">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>

        <div class="col-sm-3">
            <label>Período: </label>
            <select name="periodo" class="form-control">
                <option disabled="true" selected="true"> </option>
	  			<option>BIMESTRAL</option>
                <option>TRIMESTRAL</option>
                <option>SEMESTRAL</option>
                <option>ANUAL</option>
	  		</select>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block">Salvar</button>
</form>
@stop
