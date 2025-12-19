<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Yazarlar listesi
     */
    public function index()
    {
        $authors = Author::latest()->paginate(12);
        return view('front.pages.authors', compact('authors'));
    }
}
