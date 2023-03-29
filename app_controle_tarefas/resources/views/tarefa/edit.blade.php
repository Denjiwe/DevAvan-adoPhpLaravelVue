@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar tarefa</div>

                <div class="card-body">
                    <form action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tarefa" class="form-label">Tarefa</label>
                            <input type="text" class="form-control" value="{{ $tarefa->tarefa ?? old('tarefa') }}" name="tarefa">
                            {{ $errors->has('tarefa') ? $errors->first('tarefa') : '' }}
                        </div>

                        <div class="mb-3">
                            <label for="data_limite_conclusao" class="form-label">Data limite para a conclusão</label>
                            <input type="date" class="form-control" name="data_limite_conclusao" value="{{ $tarefa->data_limite_conclusao ?? old('data_limite_conclusao') }}">
                            {{ $errors->has('data_limite_conclusao') ? $errors->first('data_limite_conclusao') : '' }}
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
