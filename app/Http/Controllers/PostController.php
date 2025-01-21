<?php

namespace App\Http\Controllers;

use App\Models\Post;  // Import the Post model
use Illuminate\Http\Request;

class PostController extends Controller


{
    public function index()
    {
        // Fetch all posts with the author relationship
        $posts = Post::with('user')->get();

        return view('posts.index', compact('posts'));
    }


    // Display the form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store the new post in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        // Create the new post
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => auth()->id(), // Associate post with the logged-in user
        ]);

        // Redirect to the posts index (or any other page)
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        // Check if the logged-in user is the post owner
        if ($post->user_id !== auth()->id()) {
            return abort(403, 'Unauthorized action');
        }

        // Delete the post
        $post->delete();

        // Redirect to the posts index with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
