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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

                {{-- Flash Success Message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<hr>

<h3 class="mt-5 mb-4">Comments ({{ $post->comments->count() }})</h3>

{{-- Add Comment Form --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-subtitle mb-3 text-muted">Add a comment:</h6>
        <form method="POST" action="{{ route('posts.comments.store', $post) }}">
            @csrf
            <div class="mb-3">
                <textarea name="body" class="form-control @error('body') is-invalid @enderror" 
                          rows="3" placeholder="What do you think about this post?"></textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>
</div>

{{-- List of Comments --}}
@if($post->comments->isEmpty())
    <p class="text-muted">No comments yet. Be the first to comment!</p>
@else
    @foreach($post->comments()->latest()->get() as $comment) {{-- latest() = newest first --}}
        <div class="border-start border-primary border-4 ps-4 mb-4 bg-light p-3 rounded">
            <p class="mb-2">{!! nl2br(e($comment->body)) !!}</p>
            <small class="text-muted">
                💬 {{ $comment->created_at->diffForHumans() }} 
                <span class="badge bg-secondary ms-2">{{ $comment->created_at->format('M d, Y H:i') }}</span>
            </small>
        </div>
    @endforeach
@endif
            </div>
        </div>
    </div>
</body>
</html>