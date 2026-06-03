<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Author;

class MovieController extends Controller
{
    public function index()
    {
        $data = Movie::with('author')->paginate(10);
        return view('movies', compact('data'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('movies_form', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'description' => 'nullable',
            'synopsis' => 'nullable',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author_id' => $request->input('author_id'),
            'synopsis' => $request->input('synopsis'),
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Movie::create($data);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $authors = Author::all();
        return view('movies_form', compact('movie', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author_id' => $request->input('author_id'),
            'synopsis' => $request->input('synopsis'),
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}