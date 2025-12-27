<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - My Mini Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-5">
        <a href="/posts" class="btn btn-secondary mb-4">← Back to Posts</a>

        <div class="card shadow">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="text-muted mb-4">
                    By <strong>{{ $post->user->name }}</strong> • 
                    {{ $post->created_at->format('M d, Y') }} • 
                    {{ $post->comments->count() }} comment{{ $post->comments->count() != 1 ? 's' : '' }}
                </p>

                <div class="post-body mb-5">
                    {!! nl2br(e($post->body)) !!}
                </div>

                <hr>

                <h3 class="mt-5 mb-4">Comments ({{ $post->comments->count() }})</h3>

                @if($post->comments->isEmpty())
                    <p class="text-muted">No comments yet. Be the first!</p>
                @else
                    @foreach($post->comments as $comment)
                        <div class="border-start border-primary border-4 ps-4 mb-4">
                            <p class="mb-2">{!! nl2br(e($comment->body)) !!}</p>
                            <small class="text-muted">
                                Commented on {{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>