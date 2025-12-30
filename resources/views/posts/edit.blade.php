<x-app-layout>

    <x-slot name="header">
        <a href="{{ route('posts.show', $post) }}" class="inline-block mb-4 text-blue-600 hover:text-blue-800 font-medium">
            ← Back to post
        </a>
        <h1 class="text-4xl font-bold text-gray-900">Edit Post</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-8">
                    <label for="title" class="block text-gray-700 font-semibold mb-3 text-lg">
                        Post Title
                    </label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $post->title) }}"
                           class="w-full border border-gray-300 rounded-lg px-5 py-4 text-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('title') border-red-500 @enderror" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-10">
                    <label for="body" class="block text-gray-700 font-semibold mb-3 text-lg">
                        Content
                    </label>
                    <textarea name="body" id="body" rows="12" 
                              class="w-full border border-gray-300 rounded-lg px-5 py-4 text-base focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('body') border-red-500 @enderror"
                              required>{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('posts.show', $post) }}" 
                       class="px-8 py-4 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium shadow-md hover:shadow-lg transition">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>