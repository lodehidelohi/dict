@extends('layout')

@section('title', isset($book) ? 'Edit Book' : 'Add Book')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ isset($book) ? 'Edit Book' : 'Add Book' }}</h5>
        </div>
        <div class="card-body">

            <form action="{{ isset($book)
        ? route('books.update', $book->id)
        : route('books.store') }}" method="POST" enctype="multipart/form-data">
                

                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" value="{{ $book->author ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Genre</label>
                    <input type="text" name="genre" class="form-control" value="{{ $book->genre ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Publication Year</label>
                    <input type="number" name="publication_year" class="form-control"
                        value="{{ $book->publication_year ?? '' }}">
                </div>
                <div class="mb-3">
                    <label>Cover Image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    @if(isset($book) && $book->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" width="80">
                            <small class="text-muted d-block">Current image — upload new to replace</small>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $book->description ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection