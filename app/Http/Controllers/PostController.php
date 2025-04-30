<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $posts = Post::with(['category'])
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->paginate(9);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(); 
        return view('post.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
  

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $imageUrl = null;
    
        if ($request->hasFile('image')) {
            
            $uploadedFile = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'idearium/posts']
            );
    
            $imageUrl = $uploadedFile['secure_url']; 
        }
    
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $imageUrl,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Post criado com sucesso!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
