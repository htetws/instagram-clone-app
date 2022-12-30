<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('Pages.profile', compact('user'));
    }

    public function edit(User $user)
    {
        $this->profileValidation($user);

        $user->name = request('name');
        $user->username = request('username');
        $user->bio = request('bio');
        $user->email = request('email');

        if (request('avatar') !== null) {
            $imgName = uniqid() . 'profile' . request('avatar')->getClientOriginalName();
            if ($user->avatar !== null) {
                Storage::delete('public/' . $user->avatar);
            }
            request('avatar')->storeAs('public', $imgName);
            $user->avatar = $imgName;
        }

        $user->save();

        return redirect('/')->with('updated', 'profile updated.');
    }

    protected function profileValidation($user)
    {
        return request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email',
            'bio' => 'max:255',
            'avatar' => 'file|mimes:jpg,jpeg,png,webp'
        ]);
    }
}
