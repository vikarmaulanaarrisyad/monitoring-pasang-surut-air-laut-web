<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Sensor;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'publish')
            ->limit(8)
            ->get();

        return view('layouts.front', compact('posts'));
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('front.blog.single_post', compact('post'));
    }

    public function monitoring()
    {
        $sensors = Sensor::orderBy('id','DESC')->get();

        return view('front.monitoring.index', compact('sensors'));
    }
}
