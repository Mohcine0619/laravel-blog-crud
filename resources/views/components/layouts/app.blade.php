<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
            @yield('title') - 
        @endif
        My Laravel Blog
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">

        
        @isset($header)
            <header class="mb-10">
                {{ $header }}
            </header>
        @else
            <header class="mb-10">
                <h1 class="text-4xl font-bold text-gray-900">
                    <a href="/posts">My Laravel Blog</a>
                </h1>
                <p class="text-gray-600 mt-2">A simple blog built with Laravel & Tailwind</p>
            </header>
        @endisset

       
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-8">
                {{ session('success') }}
            </div>
        @endif

       
        <main>
            {{ $slot }}
        </main>

        
        <footer class="mt-16 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
            Built with ❤️ using Laravel {{ app()->version() }} • {{ now()->year }}
        </footer>
    </div>
</body>
</html>