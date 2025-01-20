<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Comment added successfully!');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment); // Ensure the user owns the comment

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update(['content' => $request->content]);

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

