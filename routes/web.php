<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveController;

Route::group(['middleware' => 'auth.prevent'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('explore', [ExploreController::class, 'index'])->name('explore');

    Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile');

    Route::get('/p/{post:id}', [PostController::class, 'show'])->name('post.detail');

    Route::post('create', [PostController::class, 'store'])->name('create');

    Route::post('/profile/{user:username}', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('can:edit,user');

    Route::post('follow/{user:username}', [FollowController::class, 'store'])->name('follow');

    Route::post('like', [LikeController::class, 'store'])->name('like');

    Route::post('save', [SaveController::class, 'store'])->name('save');

    Route::post('cmt', [CommentController::class, 'show'])->name('getPost');

    Route::post('cmts', [CommentController::class, 'store'])->name('comment');

    Route::post('detail/like', [AjaxController::class, 'like_store'])->name('detail.like');

    Route::post('detail/cmts', [AjaxController::class, 'cmt_store'])->name('detail.cmts');

    Route::post('detail/follow', [AjaxController::class, 'follow_store'])->name('detail.follow');

    Route::post('search', [AjaxController::class, 'show'])->name('search');
});
