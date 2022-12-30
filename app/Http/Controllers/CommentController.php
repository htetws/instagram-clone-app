<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //getPost
    public function show(Request $req)
    {
        $post = Post::with('user', 'images', 'comments.user')->findOrFail($req->id);
        return response()->json($post, 200);
    }

    public function store(Request $req)
    {
        Comment::create([
            'post_id' => $req->id,
            'comment' => $req->input,
            'user_id' => auth()->user()->id
        ]);

        $cmts = Comment::where('post_id', $req->id)->get();
        return response()->json($cmts, 200);
    }
}
