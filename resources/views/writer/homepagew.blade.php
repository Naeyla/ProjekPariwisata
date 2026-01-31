<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KisahOmbak - Homepage</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
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
                <input type="text" placeholder="Search" class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="absolute right-3 top-2.5 text-gray-400">
                    🔍
                </span>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 border rounded-full hover:bg-gray-100">
                    ✏️
                </button>
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
                    <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                        <div class="flex-1 p-4 text-blue-900">For You - Rekomendasi 1</div>
                        <div class="w-40 bg-gray-300 flex items-center justify-center text-gray-700">Gambar 1</div>
                    </div>
                    <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                        <div class="flex-1 p-4 text-blue-900">For You - Rekomendasi 2</div>
                        <div class="w-40 bg-gray-300 flex items-center justify-center text-gray-700">Gambar 2</div>
                    </div>
                    <!-- Bisa tambah banyak lagi -->
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

