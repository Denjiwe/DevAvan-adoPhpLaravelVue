<x-mail::message>
# {{ $tarefa }}

Data limite de conclusão da tarefa: {{ $data_limite_conclusao}}

<x-mail::button :url="$url">
Clique aqui para ver a tarefa
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
