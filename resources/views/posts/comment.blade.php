@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h2 class="text-black dark:text-white mb-4">Other Users' Posts</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Check if there are posts -->
        @if ($posts->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">No posts available.</p>
        @else
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $post->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $post->description }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Category: {{ $post->category }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Posted by: {{ $post->user->name }}</p>

                    <!-- Comments Section -->
                    <div class="mt-4">
                        <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300">Comments</h4>

                        <!-- Display existing comments -->
                        <ul class="mt-2 space-y-4">
                            @foreach ($post->comments as $comment)
                                <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->comment }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">By: {{ $comment->user->name }}</p>

                                    @if ($comment->user_id === auth()->id())
                                        <!-- Edit Comment -->
                                        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="comment" class="form-control w-full" required>{{ $comment->comment }}</textarea>
                                            <button type="submit" class="btn btn-primary mt-2">Update Comment</button>
                                        </form>

                                        <!-- Delete Comment -->
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Comment</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <!-- Add New Comment -->
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="comment" class="form-control w-full" placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
