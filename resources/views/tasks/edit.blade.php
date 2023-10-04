@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            <p>
                <a href="{{ route('tasks.show', ['task' => $task]) }}">
                    &larr; Wróć do zadania
                    <b> {{ $task->title }} </b>
                </a>
            </p>

            @include('tasks.components.form', [
                'action' => route('tasks.update', ['task' => $task]),
                'method' => 'PUT',
                'titleValue' => old('title', $task->title),
                'contentValue' => old('content', $task->content),
                'tagsValue' => old('tags', $task->tags->pluck('id')->toArray()),
                'submitBtnText' => 'Zaktualizuj zadanie',




            ])




        </div>
    </div>
</div>


@endsection