@extends('layout')

@section('title', isset($author) ? 'Edit Author' : 'Add Author')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ isset($author) ? 'Edit Author' : 'Add Author' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($author)
        ? route('authors.update', $author->id)
        : route('authors.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $author->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $author->email ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-control" value="{{ $author->nationality ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3">{{ $author->bio ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection