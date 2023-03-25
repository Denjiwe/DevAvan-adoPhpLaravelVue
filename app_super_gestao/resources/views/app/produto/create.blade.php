@extends('app.layout.basico')

@section('titulo', 'Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            @if (isset($produto->id))
                <p>Alterar Produto</p>
            @else 
                <p>Adicionar Produto</p>
            @endif
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:30%; margin-left: auto; margin-right: auto;">
                @component('app.produto._components.form_edit_create', ['unidades' => $unidades, 'fornecedores' => $fornecedores])
                @endcomponent
            </div>
        </div>

    </div>

@endsection