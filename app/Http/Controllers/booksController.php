<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
class booksController extends Controller
{
       public function index()
{
    $data = books::paginate(10);
    return view('books', compact('data'));
}
}
