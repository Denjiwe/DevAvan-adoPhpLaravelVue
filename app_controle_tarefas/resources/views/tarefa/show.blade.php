@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa }}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="data_limite_conclusao" class="form-label" >Data limite para a conclusão</label>
                            <input type="date" class="form-control" value="{{ $tarefa->data_limite_conclusao }}" name="data_limite_conclusao">
                        </div>
                    </fieldset>

                    <a href="{{ route('tarefa.index') }}" type="submit" class="btn btn-primary">Tarefas</a>
                    <a href="{{ url()->previous() }}" type="submit" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
