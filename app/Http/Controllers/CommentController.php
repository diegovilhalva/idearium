<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $comment = $post->comments()->create([
        'user_id' => Auth::id(),
        'body' => $request->body,
    ]);

    $comment->load('user'); 

    return response()->json($comment);
}


    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();

        return response()->json([
            'comments' => $comments
        ]);
    }
}