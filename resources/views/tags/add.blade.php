@extends('layouts.app')

@section('title', 'TODO')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="col-sm-12 col-lg-8 offset-lg-2">
            @include('tags.components.form', [
                'action'        => route('tags.store'),
                'method'        => 'POST',
                'nameValue'     => old('name'),
                'submitBtnText' => 'Dodaj nowy tag'

                
                
                ])
            
            
        </div>
    </div>
</div>
@endsection