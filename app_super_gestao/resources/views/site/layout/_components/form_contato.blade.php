<form action='{{ route('site.contato') }}' method="post">
    @csrf
    <input type="text" value="{{ old('nome') }}" placeholder="Nome" name="nome" class="{{ $classe }}">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
    <br>
    <input type="text" value="{{ old('telefone') }}" placeholder="Telefone" name="telefone" class="{{ $classe }}">
    {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
    <br>
    <input type="text" value="{{ old('email') }}" placeholder="E-mail" name="email" class="{{ $classe }}">
    {{ $errors->has('email') ? $errors->first('email') : '' }}
    <br>
    <select class="{{ $classe }}" name="motivo_contatos_id">
        <option value="" hidden selected>Qual o motivo do contato?</option>
        @foreach ($motivo_contatos as $key => $motivo_contato)
            <option value="{{$motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : ''}}>{{$motivo_contato->motivo_contato}}</option>
        @endforeach
    </select>
    {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }}
    <br>
    <textarea class="{{ $classe }}" name="mensagem">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
    <br>    
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>