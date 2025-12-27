<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-4xl font-bold text-gray-900">Create New Post</h1>
    </x-slot>


    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" id="title" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" 
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="body" class="block text-gray-700 font-medium mb-2">Body</label>
            <textarea name="body" id="body" rows="4" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" 
                      required>{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <input type="submit" value="Create Post" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

    </form>
</x-layouts.app>