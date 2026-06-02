<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;

class booksController extends Controller
{
    public function index()
    {
        $data = books::paginate(10);

        return view('books', compact('data'));
    }

    public function create()
    {
        return view('books_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'publication_year' => 'required',
        ]);

        books::create($request->only(['title', 'author', 'genre', 'publication_year', 'description']));

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function edit($id)
    {
        $book = books::findOrFail($id);

        return view('books_form', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = books::findOrFail($id);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        books::findOrFail($id)->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
