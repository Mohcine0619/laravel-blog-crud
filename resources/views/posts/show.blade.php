<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-start">
            <div>
                <a href="/posts" class="inline-block mb-4 text-blue-600 hover:text-blue-800 font-medium">
                    ← Back to posts
                </a>
                <h1 class="text-4xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="text-gray-600 mt-3">
                    By <span class="font-medium">{{ $post->user->name }}</span> • 
                    {{ $post->created_at->format('M d, Y') }} • 
                    {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                </p>
            </div>

            <!-- Edit & Delete Buttons - Only for post owner when logged in -->
            @auth
                @if(auth()->id() === $post->user_id)
                    <div class="flex space-x-3">
                        <a href="{{ route('posts.edit', $post) }}" 
                           class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 font-medium transition">
                            Edit Post
                        </a>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this post? All comments will be deleted too.')"
                                    class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium transition">
                                Delete Post
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <article class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-10">

                <!-- Post Content -->
                <div class="prose prose-lg max-w-none text-gray-800 mb-16">
                    {!! nl2br(e($post->body)) !!}
                </div>

                <hr class="border-gray-300 my-16">

                <!-- Comments Section -->
                <h3 class="text-3xl font-bold text-gray-900 mb-8">
                    Comments ({{ $post->comments->count() }})
                </h3>

                <!-- Comment Form - Only for logged-in users -->
                @auth
                    <div class="bg-gray-50 rounded-xl p-8 mb-12 border border-gray-200">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Leave a comment</h4>
                        <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                            @csrf
                            <div class="mb-5">
                                <textarea name="body" rows="5" 
                                          class="w-full border border-gray-300 rounded-lg px-5 py-4 text-base focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('body') border-red-500 @enderror"
                                          placeholder="Share your thoughts..." required>{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-medium shadow-md hover:shadow-lg transition">
                                Post Comment
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-gray-600 italic mb-12">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Log in</a> to leave a comment.
                    </p>
                @endauth

                <!-- Comments List -->
                @if($post->comments->isEmpty())
                    <p class="text-gray-500 italic text-lg">No comments yet. Be the first to share your thoughts!</p>
                @else
                    <div class="space-y-8">
                        @foreach($post->comments()->latest()->get() as $comment)
                            <div class="bg-gray-50 rounded-xl p-8 border border-gray-200">
                                <p class="text-gray-800 text-lg leading-relaxed mb-4">
                                    {!! nl2br(e($comment->body)) !!}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </article>
    </div>

</x-app-layout>