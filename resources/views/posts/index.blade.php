<x-layouts.app>

    <x-slot name="header">
        <h1 class="text-4xl font-bold text-gray-900">All Posts</h1>
        <p class="text-gray-600 mt-2">Latest thoughts and ideas</p>
    </x-slot>

    <div class="space-y-8">
        @if($posts->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <p class="text-gray-500 text-lg">No posts yet.</p>
            </div>
        @else
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="/posts/{{ $post->id }}" class="text-gray-900 hover:text-blue-600">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <div class="text-sm text-gray-600 mb-4">
                        By {{ $post->user->name }} • 
                        {{ $post->created_at->diffForHumans() }} • 
                        {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                    </div>
                    <p class="text-gray-700">
                        {{ Str::limit($post->body, 200) }}
                    </p>
                </article>
            @endforeach

            <div class="mt-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

</x-layouts.app>