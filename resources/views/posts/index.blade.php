<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">All Posts</h1>
                <p class="text-gray-600 mt-2">Latest thoughts and ideas</p>
            </div>

            <!-- New Post Button - Only for logged-in users -->
            @auth
                <a href="{{ route('posts.create') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition">
                    + New Post
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @if($posts->isEmpty())
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-lg">No posts yet. Be the first to share something!</p>
                @auth
                    <a href="{{ route('posts.create') }}" 
                       class="mt-6 inline-block text-blue-600 hover:underline font-medium">
                        Create your first post
                    </a>
                @endauth
            </div>
        @else
            <div class="space-y-8">
                @foreach($posts as $post)
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-200 overflow-hidden">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold mb-3">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="text-gray-900 hover:text-blue-600 transition">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <div class="text-sm text-gray-600 mb-4">
                                By <span class="font-medium">{{ $post->user->name }}</span> • 
                                {{ $post->created_at->diffForHumans() }} • 
                                {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                            </div>

                            <p class="text-gray-700 mb-6 leading-relaxed">
                                {{ Str::limit($post->body, 250) }}
                            </p>

                            <!-- Edit & Delete Buttons - Only for post owner when logged in -->
                            @auth
                                @if(auth()->id() === $post->user_id)
                                    <div class="flex space-x-3 pt-4 border-t border-gray-100">
                                        <a href="{{ route('posts.edit', $post) }}" 
                                           class="text-yellow-600 hover:text-yellow-700 font-medium flex items-center">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this post? All comments will be deleted too.')"
                                                    class="text-red-600 hover:text-red-700 font-medium flex items-center">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

</x-app-layout>