<x-layouts.app>

    <x-slot name="header">
        <a href="/posts" class="inline-block mb-4 text-blue-600 hover:text-blue-800 font-medium">
            ← Back to posts
        </a>
        <h1 class="text-4xl font-bold text-gray-900">{{ $post->title }}</h1>
        <p class="text-gray-600 mt-2">
            By {{ $post->user->name }} • {{ $post->created_at->format('M d, Y') }}
        </p>
    </x-slot>

    <article class="bg-white rounded-lg shadow-lg p-8">
        <div class="prose prose-lg max-w-none mb-12 text-gray-800">
            {!! nl2br(e($post->body)) !!}
        </div>

        <hr class="my-12">

        <h3 class="text-2xl font-bold mb-6">Comments ({{ $post->comments->count() }})</h3>

        <!-- Comment Form -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                @csrf
                <textarea name="body" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" 
                          placeholder="Share your thoughts..." required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Post Comment
                </button>
            </form>
        </div>

        <!-- Comments List -->
        @if($post->comments->isEmpty())
            <p class="text-gray-500 italic">No comments yet. Be the first!</p>
        @else
            <div class="space-y-6">
                @foreach($post->comments()->latest()->get() as $comment)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <p class="text-gray-800 mb-3">{!! nl2br(e($comment->body)) !!}</p>
                        <p class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </article>

</x-layouts.app>