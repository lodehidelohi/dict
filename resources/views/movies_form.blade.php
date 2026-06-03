@extends('layout')

@section('title', isset($movie) ? 'Edit Movie' : 'Add Movie')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ isset($movie) ? 'Edit Movie' : 'Add Movie' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($movie)
    ? route('movies.update', $movie->id)
    : route('movies.store') }}" method="POST"
        enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $movie->title ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <select name="author_id" class="form-control">
                        <option value="">-- Select Author --</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ isset($movie) && $movie->author_id == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $movie->description ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Synopsis</label>
                    <textarea name="synopsis" class="form-control" rows="4">{{ $movie->synopsis ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Cover Image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    @if(isset($movie) && $movie->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $movie->cover_image) }}" width="80">
                            <small class="text-muted d-block">Current image — upload new to replace</small>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection