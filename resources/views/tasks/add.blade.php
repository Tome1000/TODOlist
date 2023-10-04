@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            
        @include('tasks.components.form', [
                'action' => route('tasks.store'),
                
                'titleValue' => old('title'),
                'contentValue' => old('content'),
                'tagsValue' => old('tags', []),
                'submitBtnText' => 'Dodaj zadanie',




            ])
    </div>
</div>


@endsection