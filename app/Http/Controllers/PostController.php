<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $req)
    {
        Validator::validate($req->all(), [
            'caption' => 'required|max:255',
            'images' => 'required'
        ]);

        $post = Post::create([
            'caption' => $req->caption,
            'user_id' => auth()->id()
        ]);

        if ($req->hasFile('images')) {

            foreach ($req->images as $image) {
                $imgName = uniqid() . $image->getClientOriginalName();
                $image->storeAs('public', $imgName);
                Image::create([
                    'post_id' => $post->id,
                    'images' => $imgName
                ]);
            }
        }

        return back()->with('stored', 'Shared post.');
    }

    public function show($post)
    {
        $post = Post::with('images', 'user', 'comments.user')->findOrFail($post);
        return view('Pages.detail', compact('post'));
    }

    public function destroy(Request $req)
    {
        return response()->json(Post::find($req->id)->delete(), 200);
    }

    // public function edit(Post $post)
    // {
    //     $this->authorize('edit', $post->user);
    //     return $post;
    // }
}
