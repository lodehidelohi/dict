@extends('layout')

@section('title', 'Books')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Book List</h5>
        <div>
            <span class="badge bg-primary me-2">Total Books: {{ $data->total() }}</span>
            <a href="{{ route('books.create') }}" class="btn btn-success btn-sm">+ Add Book</a>
        </div>
    </div>

    <div class="card-body">

        @if($data->count() > 0)

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Publication Year</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->genre }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('books.delete', $book->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this book?')">
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
            <div class="alert alert-info mb-0">No books found.</div>
        @endif

    </div>

</div>

@endsection