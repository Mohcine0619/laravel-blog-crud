<x-layouts.app>

    <x-slot name="header">
        <a href="{{ route('posts.show', $post) }}" class="inline-block mb-4 text-blue-600 hover:text-blue-800 font-medium">
            ← Back to post
        </a>
        <h1 class="text-4xl font-bold text-gray-900">Edit Post</h1>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $post->title) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="body" class="block text-gray-700 font-medium mb-2">Content</label>
                    <textarea name="body" id="body" rows="10" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('body') border-red-500 @enderror"
                              required>{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('posts.show', $post) }}" 
                       class="px-6 py-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Update Post
                    </button>
                </div>
            </form>

        </div>
    </div>

</x-layouts.app>