<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $req)
    {
        auth()->user()->likeable($req->id);
        $post = Post::findOrFail($req->id);
        return response()->json($post->likes->count(), 200);
    }
}
