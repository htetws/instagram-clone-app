<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        return view('Pages.explore', [
            'posts' => Post::inRandomOrder()->whereNotIn('user_id', auth()->user()->follows->pluck('id'))->whereNot('user_id', auth()->id())->with('images')->latest()->get()
        ]);
    }
}
