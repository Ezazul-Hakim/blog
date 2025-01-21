<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // Get all posts with their author and comments
        $posts = Post::with(['user', 'comments.user'])->get();
        return view('posts.comment', compact('posts'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);
        \Log::info('New comment:', ['comment' => $request->input('comment')]);
        return redirect()->route('posts.index')->with('success', 'Comment added successfully!');
    }

    public function edit(Comment $comment)
    {
//        $this->authorize('update', $comment); // Ensure the user owns the comment

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
//        $this->authorize('update', $comment);

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->update(['comment' => $request->comment]);

        return redirect()->route('posts.index')->with('success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->post->user_id === auth()->id() || $comment->user_id === auth()->id()) {
            $comment->delete();
            return redirect()->route('posts.index')->with('success', 'Comment deleted successfully!');
        }

        abort(403, 'Unauthorized action.');
    }
}

