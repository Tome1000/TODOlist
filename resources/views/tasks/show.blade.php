@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2 mb-3">
            <div class="d-flex w-100 justify-content-end">

                <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POST" novalidate>
                    <input type="hidden" name="title" value="{{ $task->title }}">
                    <input type="hidden" name="content" value="{{ $task->content }}">


                    @method('PUT')
                    @csrf

                    @if($task->hasStatus('Active'))
                    <input type="hidden" name="status" value="{{  Task::getStatus('Completed') }}">
                    <button type="submit" class="btn btn-success">
                        Oznacz jako zakończone
                    </button>

                    @else
                    <input type="hidden" name="status" value="{{  Task::getStatus('Active') }}">
                    <button type="submit" class="btn btn-success">
                        Oznacz jako aktywne
                    </button>
                    @endif
                </form>
            </div>

            <div class="col-sm-12 col-lg-8 offset-lg-2" style="margin-left:0px;">
                <h1>
                    {{ $task->title }}
                </h1>


                @if($task->tags->isNotEmpty())
                <div class="d-flex mb-3">

                    @foreach($task->tags->take(5) as $tag)
                    <span class="badge {{ Arr::random(['badge bg-primary', 'badge bg-secondary', 'badge bg-success', 'badge bg-dark']) }}" style="margin-right:3px;">
                        {{ $tag->getDisplayName()}}
                    </span>
                    @endforeach

                </div>
                @endif


                <small>
                    <p>
                        <b>Utworzone: </b>

                        {{ $task->created_at->format('Y-m-d')}}
                    </p>
                </small>
                @if($task->content)
                <p>{{ $task->content }}</p>
                @endif
                <p>
                    Status zadania:

                    @switch($task->status)
                    @case(\App\Models\Task::getStatus('Active'))
                    <b> Aktywne</b>
                    @break

                    @case(\App\Models\Task::getStatus('Completed'))
                    <b> Ukończone</b>
                    @break
                    @endswitch
                </p>
            </div>
            <div class="col-sm-12">
                <div class="d-flex">
                    <a href=" {{ route('tasks.edit', ['task' => $task]) }}" class="btn btn-success">
                        {{__('task.common.edit')}}
                    </a>
                    <form action="{{ route('tasks.delete', ['task' => $task]) }}" method="POST" novalidate>
                        <button class="btn btn-danger" type="sumbit" style="margin-left: 3px">
                            {{__('task.common.delete')}}
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


@endsection