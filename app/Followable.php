<?php

namespace App;

use App\Models\Post;
use App\Models\User;

trait Followable
{
    public function follow($user)
    {
        return $this->follows()->toggle($user);
    }

    public function isFollowing($user)
    {
        return (bool) $this->follows->contains($user);
    }

    public function getAvatar()
    {
        return $this->avatar !== null ? asset('storage/' . $this->avatar) : 'https://i.pravatar.cc/150?u=' . $this->email;
    }

    public function getRouteKeyName()
    {
        return 'username';
    }


    //for like

    public function likeable($post)
    {
        return $this->likes()->toggle($post);
    }

    public function isLike($post)
    {
        return (bool) $this->likes->contains($post);
    }

    //for save
    public function savePost($post)
    {
        return $this->saves()->toggle($post);
    }
    public function isSaved($post)
    {
        return (bool) $this->saves->contains($post);
    }
}
