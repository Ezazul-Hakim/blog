@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-black dark:text-white">Create a New Post</h2>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <!-- Title Field -->
            <div class="form-group">
                <label for="title" class="text-black dark:text-white">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="description" class="text-black dark:text-white">Description</label>
                <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
            </div>

            <!-- Category Field -->
            <div class="form-group">
                <label for="category" class="text-black dark:text-white">Category</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn mt-3 px-6 py-2 text-black dark:text-white font-semibold rounded-lg">
                Create Post
            </button>
        </form>
    </div>
@endsection
