@extends('layout')

@section('title', 'Books')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Book List</h5>

        <span class="badge bg-primary">
          Total Books: {{ $data->total() }}
        </span>
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
                            </tr>

                        @endforeach

                    </tbody>

                </table>

  {{ $data->links() }}
            </div>

        @else

            <div class="alert alert-info mb-0">
                No books found.
            </div>

        @endif

    </div>

</div>

@endsection