<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    public function like_store(Request $req)
    {
        $post = Post::findOrFail($req->id);
        auth()->user()->likeable($post);
        return response()->json(Like::where('post_id', $post->id)->get(), 200);
    }

    public function cmt_store(Request $req)
    {
        Comment::create([
            'post_id' => $req->id,
            'comment' => $req->input,
            'user_id' => auth()->user()->id
        ]);

        $cmts = Comment::with('user')->where('post_id', $req->id)->latest()->get();
        return response()->json($cmts, 200);
    }

    public function follow_store(Request $req)
    {
        $user = User::findOrFail($req->id);
        auth()->user()->follows()->toggle($user);
        return response()->json($user, 200);
    }

    public function show(Request $req)
    {
        if ($req->input !== null) {
            $user = User::where('username', 'like', '%' . $req->input . '%')
                ->orWhere('name', 'like', '%' . $req->input . '%')
                ->get();
        }
        return response()->json($user, 200);
    }

    public function destroy_img(Request $req)
    {
        $imgName = Image::findOrFail($req->id);
        Image::findOrFail($req->id)->delete();
        if ($imgName) Storage::delete('public/' . $imgName->images);
        return response()->json('deleted', 200);
    }
}
