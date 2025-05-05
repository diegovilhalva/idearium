<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->paginate(9);
        return view('profile.show',[
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
