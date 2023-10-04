@component('mail::message')
<h1>Masz nowe zadanie do wykonania: {{$task->title}}</h1>
<p>Szczegóły tego zadania możesz zobaczyć <a href="{{ route('tasks.show', ['task' => $task]) }}">tutaj<a></p>

@endcomponent