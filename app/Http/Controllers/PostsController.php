<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function showPosts()
    {
        $posts = Post::with('comments')->get();

        return response()->json($posts);
    }
}
