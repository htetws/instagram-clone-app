<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        $following = auth()->user()->follows->pluck('id');

        $users = User::inRandomOrder()->whereNotIn('id', $following)->whereNot('id', auth()->id())->take(5)->get();

        $posts = Post::whereIn('user_id', $following)
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

        return view('Layouts.index', compact('posts', 'users'));
    }
}
