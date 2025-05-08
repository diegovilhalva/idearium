<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PostController extends Controller
{
    use AuthorizesRequests;
    /*
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with(['category'])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);
        return view('post.index', ['posts' => $posts, 'active' => null]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', ['categories' => $categories]);
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
        $publicId = null;

        if ($request->hasFile('image')) {

            $uploadedFile = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'idearium/posts']
            );

            $imageUrl = $uploadedFile['secure_url'];
            $publicId = $uploadedFile['public_id'];
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
            'image' => $imageUrl,
            'image_public_id' => $publicId,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();

        return view('post.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('post.show', [$post->user->username, $post])
            ->with('success', 'Post atualizado com sucesso!');
    }


    public function toggleLike(Post $post)
    {


        $user = Auth::user();

        $like = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false, 'likes_count' => $post->likes()->count()]);
        }

        Like::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        return response()->json(['liked' => true, 'likes_count' => $post->likes()->count()]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image_public_id) {
            Cloudinary::uploadApi()->destroy($post->image_public_id);
        }

        $post->delete();

        return redirect()->route('post.mine')->with('success', 'Post deletado com sucesso.');
    }


    public function category($slug)
    {
        if ($slug === 'tudo' || $slug === '') {
            $posts = Post::latest()->paginate(9);
        } else {
            $category = Category::where('slug', $slug)->firstOrFail();
            $posts = $category->posts()->paginate(9);
        }

        return view('post.index', [
            'posts' => $posts,
            'categories' => Category::all(),
            'active' => $slug
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        })->latest()->paginate(9);

        return view('post.index', [
            'posts' => $posts,
            'categories' => Category::all(),
            'active' => null
        ]);
    }


    public function userPosts()
    {
        $posts = auth()->user()->posts()->latest()->paginate(10);
        return view('post.mine', compact('posts'));
    }
}
