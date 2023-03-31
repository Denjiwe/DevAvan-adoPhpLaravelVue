@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Tarefas 
                        </div>
                        <div class="col-6">
                            <div class="float-end">
                            <a href="{{ route('tarefa.exportacao', ['extensao' => 'xlsx']) }}" class="me-3" style="text-decoration: none">XLSX</a>
                            <a href="{{ route('tarefa.exportacao', ['extensao' => 'csv']) }}" class="me-3" style="text-decoration: none">CSV</a>
                            <a href="{{ route('tarefa.exportarPdf') }}" class="me-3" style="text-decoration: none" target="_blank">PDF</a>
                            <a href="{{ route('tarefa.create') }}" style="text-decoration: none">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data limite</th>
                                <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $key => $tarefa)
                            <tr>
                                <th scope="row">{{ $tarefa->id }}</th>
                                <td>{{ $tarefa->tarefa }}</td>
                                <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>
                                <td><a href="{{ route('tarefa.edit', $tarefa->id) }}">Atualizar</a></td>
                                <td>
                                    <form id="form_{{$tarefa->id}}" method="POST" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id])}}">
                                    @csrf
                                    @method('DELETE')   
                                    </form>
                                    <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <ul class="pagination">

                        <li class="page-item"><a class="page-link {{ $tarefas->currentPage() == 1 ? 'disabled' : ''}}" href="{{ $tarefas->previousPageUrl() }}">Anterior</a></li>

                        @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                            <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : ''}}">
                                <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item"><a class="page-link {{ $tarefas->currentPage() == $tarefas->lastPage() ? 'disabled' : ''}}" href="{{ $tarefas->nextPageUrl() }}">Próxima</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
