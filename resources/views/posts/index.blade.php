<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog - All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">My Blog Posts</h1>

        @if($posts->count() == 0)
            <p>No posts yet!</p>
        @else
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/posts/{{ $post->id }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small">
                                    By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                </p>
                                <p class="card-text">
                                    {{ Str::limit($post->body, 150) }}
                                </p>
                                <p class="small text-muted">
                                    {{ $post->comments->count() }} comment{{ $post->comments->count() != 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>