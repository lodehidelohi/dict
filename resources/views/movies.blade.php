@extends('layout')

@section('title', 'Movies')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Movie List</h5>
            <div>
                <span class="badge bg-primary me-2">Total Movies: {{ $data->total() }}</span>
                <a href="{{ route('movies.create') }}" class="btn btn-success btn-sm">+ Add Movie</a>
            </div>
        </div>

        <div class="card-body">
            @if($data->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Synopsis</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $movie)
                                <tr>
                                    <td>{{ $movie->id }}</td>
                                    <td>
                                        @if($movie->cover_image)
                                            <img src="{{ asset('storage/' . $movie->cover_image) }}" width="50">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $movie->title }}</td>
                                    <td>{{ $movie->author->name ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($movie->description, 50) }}</td>
                                    <td>{{ Str::limit($movie->synopsis, 50) }}</td>
                                    <td>
                                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('movies.delete', $movie->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this movie?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            @else
                <div class="alert alert-info mb-0">No movies found.</div>
            @endif
        </div>
    </div>

@endsection