@extends('layout')

@section('title', 'Books')
<?php session()->put('operationname', 'books'); ?>
@section('content')

<div class="card ove







rflow-hidden">
    <div class="card-body pt-3">
        <p>
            Welcome to the Books page! You can display book records or any related content here.
        </p>
    </div>
</div>

@endsection
