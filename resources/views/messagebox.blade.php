@extends('principal')

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@stop

@section('conteudo')

<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body">
            <div class="{{ $tipo }}">
                <h4><strong>{{ $titulo }}</strong></h4>
                {{ $msg }}
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ $acao }}" type="button" class="btn btn-default">OK</a>
        </div>
    </div>
</div>
@stop
