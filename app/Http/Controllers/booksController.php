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
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'genre' => $request->input('genre'),
            'publication_year' => $request->input('publication_year'),
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }
        books::create($data);

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

        $request->validate([
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        books::findOrFail($id)->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

}
