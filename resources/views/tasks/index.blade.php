@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">

            @if(session()->has('status'))
            <div class="col-sm-12 col-lg-8 offset-lg-2">
                <div class="alert @if(session('status')['success']) alert-success @else alert-danger @endif" role="alert">
                    {{session('status')['message']}}
                </div>
            </div>
            @endif
            <div class="row">
                @forelse($tasks as $task)
                <div class="col-sm-12 ">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{Str::limit($task->title, 75)}}
                            </h5>
                            @if($task->content)
                            <p class="card-text">
                                {{Str::limit($task->content, 50)}}
                            </p>
                            @endif

                            @if($task->tags->isNotEmpty())
                            <div class="d-flex mb-3">

                                @foreach($task->tags->take(5) as $tag)
                                <span class="badge {{ Arr::random(['badge bg-primary', 'badge bg-secondary', 'badge bg-success', 'badge bg-dark']) }}" style="margin-right:3px;">
                                    {{ $tag->getDisplayName()}}
                                </span>
                                @endforeach

                            </div>
                            @endif
                            <div class="btn-group">
                                <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POST" novalidate>
                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                    <input type="hidden" name="content" value="{{ $task->content }}">
                                    <input type="hidden" name="status" value="{{  $tasksData['oppositeStatus'] }}">

                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        {{ $tasksData['labels']['mark'] }}
                                    </button>
                                </form>


                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        Więcej
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('tasks.show', ['task' => $task])}}">
                                            Szczegóły
                                        </a>
                                        <a class="dropdown-item" href="{{ route('tasks.edit', ['task' => $task]) }}">
                                            Edytuj
                                        </a>
                                        <form action="{{ route('tasks.delete', ['task' => $task]) }}" method="POST" novalidate>
                                            <button class="dropdown-item" type="sumbit">
                                                Usuń
                                            </button>
                                            @method('DELETE')
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <div class="col-sm-12">
                    <p>
                        {{ $tasksData['labels']['empty'] }}
                    </p>
                </div>
                @endforelse

                @if($tasks->hasPages())
                <div class="col-sm-12">
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection