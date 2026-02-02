<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>KisahOmbak - Homepage</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Libre+Baskerville:wght@400;700&display=swap"
        rel="stylesheet">

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

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-60 bg-white border-r border-gray-200 flex flex-col px-4 py-6">
            <!-- Logo -->
            <div class="mb-8 text-3xl font-logo text-blue-900">KisahOmbak</div>

            <!-- Menu -->
            <!-- Menu -->
            <nav class="flex flex-col gap-3">
                <a href="/homepagewriter" class="flex items-center gap-2 px-3 py-2 rounded-full bg-blue-900 text-white">
                    <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon home">
                    Home
                </a>
                <a href="/librarywriter" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100">
                    <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon library">
                    Library
                </a>
                <a href="/storieswriter" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100">
                    <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon stories">
                    Stories
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Top Bar -->
            <div class="flex items-center justify-between mb-6">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="absolute right-3 top-2.5 text-gray-400">
                        🔍
                    </span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/writer/write" class="p-2 border rounded-full hover:bg-gray-100">
                        ✏️
                    </a>
                    <div class="w-8 h-8 bg-gray-400 rounded-full"></div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-6 border-b border-gray-200 mb-4 text-blue-900 font-body">
                <button class="tab-btn border-b-2 border-blue-900 pb-1" data-tab="forYou">For You</button>
                <button class="tab-btn pb-1" data-tab="followed">Followed</button>
            </div>

            <!-- List Content -->
            <div>
                <!-- For You -->
                <div class="tab-panel" data-tab="forYou">
                    <div class="flex flex-col gap-4">
                        @php $savedArticleIds = $savedArticleIds ?? []; @endphp

                        @forelse ($articles as $article)
                            <div class="flex bg-gray-200 rounded-lg">

                                <!-- ================= LEFT CONTENT ================= -->
                                <div class="flex-1 p-4 flex flex-col justify-between min-w-0">

                                    <!-- Judul & Deskripsi -->
                                    <div>
                                        <a href="{{ route('article.show', $article) }}"
                                            class="text-blue-900 font-semibold text-lg hover:underline block">
                                            {{ $article->title }}
                                        </a>

                                        <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                            {{ Str::limit(strip_tags($article->content), 100) }}
                                        </p>
                                    </div>

                                    <!-- Info bawah kiri -->
                                    <div class="flex items-center gap-4 mt-3 text-gray-500 text-xs">
                                        <!-- Tanggal -->
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03
                     L22 9.24l-7.19-.61L12 2
                     9.19 8.63 2 9.24l5.46 4.73
                     L5.82 21z" />
                                            </svg>
                                            {{ $article->created_at->format('d M Y, H:i') }}
                                        </span>

                                        <!-- Like -->
                                        <span class="text-gray-500 text-xs flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            {{ $article->likes_count }}
                                        </span>

                                        <!-- Komentar -->
                                        <span class="text-gray-500 text-xs flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 2 13.574 2 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            {{ $article->comments_count }}
                                        </span>
                                    </div>
                                </div>

                                <!-- ================= ACTION AREA (KANAN) ================= -->
                                <div class="flex flex-col items-end justify-between p-4">

                                    <!-- Bintang -->
                                    <div class="flex gap-1 overflow-visible">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 shrink-0 text-amber-400" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03
                     L22 9.24l-7.19-.61L12 2
                     9.19 8.63 2 9.24l5.46 4.73
                     L5.82 21z" />
                                            </svg>
                                        @endfor
                                    </div>


                                    <!-- Tombol -->
                                    <div class="flex gap-2 mt-3">
                                        <!-- Show less -->
                                        <form method="POST" action="{{ route('article.hide', $article) }}"
                                            onsubmit="return confirm('Sembunyikan artikel ini dari feed?');">
                                            @csrf
                                            <button
                                                class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100"
                                                title="Show less">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Save -->
                                        <form method="POST" action="{{ route('article.save', $article) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="p-1.5 rounded-full border border-gray-300 bg-white hover:bg-gray-100 text-gray-600"
                                                title="{{ in_array($article->id, $savedArticleIds) ? 'Hapus dari Library' : 'Simpan ke Library' }}">
                                                @if (in_array($article->id, $savedArticleIds))
                                                    <svg class="w-5 h-5 text-blue-900" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- ================= FOTO ================= -->
                                <a href="{{ route('article.show', $article) }}"
                                    class="w-40 min-h-[100px] bg-gray-300 flex-shrink-0 overflow-hidden">
                                    @if ($article->cover_image)
                                        <img src="{{ $article->cover_image }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="h-full flex items-center justify-center text-gray-700 text-sm">
                                            —
                                        </div>
                                    @endif
                                </a>

                            </div>
                        @empty
                            <div class="p-4 text-gray-500">Belum ada artikel.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Followed -->
                <div class="tab-panel hidden" data-tab="followed">
                    <div class="flex flex-col gap-4">
                        <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                            <div class="flex-1 p-4 text-blue-900">Followed - Konten dari teman A</div>
                            <div class="w-40 bg-gray-300 flex items-center justify-center text-gray-700">Gambar A</div>
                        </div>
                        <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                            <div class="flex-1 p-4 text-blue-900">Followed - Konten dari teman B</div>
                            <div class="w-40 bg-gray-300 flex items-center justify-center text-gray-700">Gambar B</div>
                        </div>
                        <!-- Bisa tambah sesuai jumlah orang yang diikuti -->
                    </div>
                </div>
            </div>

            <script>
                const tabs = document.querySelectorAll('.tab-btn');
                const panels = document.querySelectorAll('.tab-panel');

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        tabs.forEach(t => t.classList.remove('border-b-2', 'border-blue-900'));
                        panels.forEach(p => p.classList.add('hidden'));

                        tab.classList.add('border-b-2', 'border-blue-900');
                        const target = tab.getAttribute('data-tab');
                        document.querySelector(`.tab-panel[data-tab="${target}"]`).classList.remove('hidden');
                    });
                });
            </script>
