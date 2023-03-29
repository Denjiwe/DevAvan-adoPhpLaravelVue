@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acesso Negado</div>

                <div class="card-body">
                    Desculpe. Voçê não tem acesso a essa página
                    <br>
                    <a href="{{ route('tarefa.index') }}" type="submit" class="btn btn-primary btn-sm">Tarefas</a>
                    <a href="{{ url()->previous() }}" type="submit" class="btn btn-secondary btn-sm">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
