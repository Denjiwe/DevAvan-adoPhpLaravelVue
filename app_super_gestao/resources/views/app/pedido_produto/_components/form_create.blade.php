<form method="post" action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}">
@csrf

    <select name="produto_id">
        <option selected>-- Selecione um Produto --</option>

        @foreach($produtos as $produto)
            <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}> {{ $produto->nome }} </option>
        @endforeach
    </select>
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <input type="number" name="qntde" value="{{ old('qntde') ? old('qntde') : '' }}" placeholder="Quantidade" class="borda-preta">
    {{ $errors->has('qntde') ? $errors->first('qntde') : '' }}

    <button type="submit" class="borda-preta">Adicionar</button>
</form>