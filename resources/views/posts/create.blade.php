@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 " style="padding-top: 3%;">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Create a New Post</h2>

            <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Title Field -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Title
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300" 
                        required
                        placeholder="Enter your post title">
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Description
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="5" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300" 
                        required
                        placeholder="Write a detailed description"></textarea>
                </div>

                <!-- Category Field -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Category
                    </label>
                    <input 
                        type="text" 
                        id="category" 
                        name="category" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300" 
                        required
                        placeholder="Enter the post category">
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
