@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            @forelse($tags as $tag)
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card bg-light mb-3">
                        <div class="card-body d-flex align-items-center justify-content-between w-100">
                            <h5 class="card-title " style="margin-bottom: 0px;">
                                Tag:
                                <b> {{ $tag ->getDisplayName()}}</b>
                            </h5>

                            <div class="btn-group">


                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        Więcej
                                    </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{ route('tags.edit', ['tag' => $tag]) }}">
                                            Edytuj
                                        </a>
                                        <form action="{{ route('tags.delete', ['tag' => $tag]) }}" method="POST" novalidate>
                                            @method('DELETE')
                                            @csrf
                                            <button class="dropdown-item" type="sumbit">
                                                Usuń
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-sm-12">
                <p>
                Stwórz pierwszy tag i przypisz go do zadania
                </p>
            </div>

            @endforelse

            @if($tags->hasPages())
            <div class="col-sm-12">
                {{ $tags->links('pagination::bootstrap-5') }}
            </div>
            @endif


        </div>
    </div>
</div>


@endsection