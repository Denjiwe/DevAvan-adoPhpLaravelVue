<h3>Fornecedores</h3>

{{-- Comentário --}}

@php
    // comentário de uma linha
    /*
    Comentário de multiplas linhas
    */
@endphp

{{-- @dd($fornecedores) imprime arrays --}}

@if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h4>Existem alguns fornecedores</h4>
@elseif(count($fornecedores) > 10)
    <h4>Existem vários fornecedores</h4>
@else
    <h4>Ainda não existem fornecedores cadastrados</h4>
@endif

@if($fornecedores[0]['status'] == 'N')
    Fornecedor inativo
@endif
<br>
@unless($fornecedores[0]['status'] == 'S')
    Fornecedor inativo<br><br>
@endunless

@isset($fornecedores)
    @foreach($fornecedores as $i => $fornecedor)
        Iteração atual: {{ $loop->iteration }} <br>
        @if($loop->first)
            Primeira iteração <br>
        @endif
        Fornecedor: {{ $fornecedor['nome'] }} <br>
        Status: {{ $fornecedor['status'] }} <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Não definido' }} <br>
        {{-- @empty($fornecedor['cnpj'])
        - Vazio <br>
        @endempty --}}
        Telefone: ({{ $fornecedor['ddd'] ?? '' }}) {{ $fornecedor['telefone'] ?? '' }} <br>
        @switch($fornecedor['ddd'])
            @case('11')
                São Paulo - SP
                @break
            @case('32')
                Juiz de Fora - MG
                @break
            @case('85')
                Fortaleza - CE
                @break
            @default
                Estado não definido
        @endswitch
        @if ($loop->last)
            <br>Última iteração
        @endif
        <hr>
    @endforeach
@endisset