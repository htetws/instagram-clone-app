<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function store(Request $req)
    {
        $post = Post::findOrFail($req->id);
        auth()->user()->savePost($post);
        return response()->json('done', 200);
    }
}
