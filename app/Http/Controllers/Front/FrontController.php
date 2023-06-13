<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'publish')
            ->limit(8)
            ->get();

        return view('front.welcome', compact('posts'));
    }
}
