<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('front.blog.index', compact('posts'));
    }
}
