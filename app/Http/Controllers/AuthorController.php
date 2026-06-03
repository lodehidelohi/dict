<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $data = Author::paginate(10);
        return view('authors', compact('data'));
    }

    public function create()
    {
        return view('authors_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'nationality' => 'nullable',
            'bio' => 'nullable',
        ]);

        Author::create($request->only(['name', 'email', 'nationality', 'bio']));

        return redirect()->route('authors.index')->with('success', 'Author added successfully.');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors_form', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $author->update([
            'name' => $request->name,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'bio' => $request->bio,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}