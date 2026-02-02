<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KisahOmbak - {{ $article->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        logo: ['Great Vibes', 'cursive'],
                        body: ['Libre Baskerville', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-body bg-white text-gray-800">

    <header class="sticky top-0 bg-white border-b border-gray-200 z-50">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button type="button" onclick="history.back()" class="p-2 rounded-full hover:bg-gray-100 text-gray-600 hover:text-gray-800 flex items-center justify-center" title="Kembali">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h1 class="text-2xl font-logo text-blue-900">KisahOmbak</h1>
            </div>
            <div class="w-8 h-8 bg-gray-400 rounded-full"></div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-8">
        @if($article->cover_image)
        <div class="mb-8">
            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full max-h-96 object-cover rounded-lg">
        </div>
        @endif

        <h2 class="text-5xl font-bold text-gray-900 mb-6">{{ $article->title }}</h2>

        <div class="article-content text-xl leading-relaxed prose prose-lg max-w-none">
            {!! $article->content !!}
        </div>

        <!-- Like -->
        <div class="mt-10 pt-6 border-t border-gray-200">
            <form method="POST" action="{{ route('article.like', $article) }}" class="inline">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-gray-600 hover:text-red-500 transition">
                    @if($userLiked)
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    @else
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    @endif
                    <span>{{ $likesCount }} Suka</span>
                </button>
            </form>
        </div>

        <!-- Comments -->
        <div class="mt-10 pt-6 border-t border-gray-200">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $article->comments->count() }} Komentar</h3>

            @if(session('success'))
                <p class="text-green-600 mb-4">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('article.comment', $article) }}" class="mb-8">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Beri rating (opsional)</label>
                    <div class="flex gap-1" id="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" class="star-btn p-1 text-gray-300 hover:text-yellow-400 focus:outline-none" data-value="{{ $i }}" aria-label="{{ $i }} bintang">
                            <svg class="w-8 h-8 star-svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                    <textarea name="comment" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis komentar..."></textarea>
                    @error('comment')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-full hover:bg-blue-800">Kirim</button>
            </form>

            <div class="space-y-6">
                @forelse($article->comments as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-semibold text-gray-900">{{ $comment->user->username ?? 'Anonim' }}</span>
                            @if($comment->rating)
                            <div class="flex gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $comment->rating)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    @else
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    @endif
                                @endfor
                            </div>
                            @endif
                        </div>
                        <p class="text-gray-700 mt-1 whitespace-pre-wrap">{{ $comment->comment }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500">Belum ada komentar.</p>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.star-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const v = this.getAttribute('data-value');
                document.getElementById('rating-input').value = v;
                document.querySelectorAll('#star-rating .star-btn').forEach((b, i) => {
                    const svg = b.querySelector('.star-svg');
                    if (i < v) {
                        b.classList.add('text-yellow-400');
                        b.classList.remove('text-gray-300');
                    } else {
                        b.classList.remove('text-yellow-400');
                        b.classList.add('text-gray-300');
                    }
                });
            });
        });
    </script>
</body>
</html>
