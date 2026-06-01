@extends('layout')

@section('title', 'Movies')
<?php session()->put('operationname', 'movies'); ?>
@section('content')

<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <p>
            Welcome to the Movies page! You can list movies here or show any related content.
        </p>
    </div>
</div>

@endsection
