<form action='{{ route('site.contato') }}' method="post">
    @csrf
    <input type="text" placeholder="Nome" name="nome" class="{{ $classe }}">
    <br>
    <input type="text" placeholder="Telefone" name="telefone" class="{{ $classe }}">
    <br>
    <input type="text" placeholder="E-mail" name="email" class="{{ $classe }}">
    <br>
    <select class="{{ $classe }}" name="motivo">
        <option value="">Qual o motivo do contato?</option>
        <option value="0">Dúvida</option>
        <option value="1">Elogio</option>
        <option value="2">Reclamação</option>
    </select>
    <br>
    <textarea class="{{ $classe }}" name="mensagem">Preencha aqui a sua mensagem</textarea>
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>