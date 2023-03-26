@if (isset($cliente->id))
    <form method="post" action="{{ route('cliente.update', ['cliente' => $cliente]) }}">
    @method('PUT') 
@else
    <form method="post" action="{{ route('cliente.store') }}">
@endif
@csrf

    <input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

    @if (isset($cliente->id))
        <button type="submit" class="borda-preta">Editar</button>
    @else
        <button type="submit" class="borda-preta">Cadastrar</button>
    @endif
</form>