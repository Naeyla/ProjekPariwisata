<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KisahOmbak - Homepage</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

    <!-- Iconfy -->
    <script src="https://code.iconify.design/3/3.1.1/iconify.min.js"></script>

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
        <nav class="flex flex-col gap-3">
                <a href="/homepagewriter"
                class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-100 text-blue-800">
                    <span
                        class="iconify text-2xl"
                        data-icon="iconamoon:home-bold">
                    </span>
                    Home
                </a>

                <a href="/librarywriter"
                class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-100 text-blue-800">
                    <span
                        class="iconify text-2xl"
                        data-icon="solar:library-linear">
                    </span>
                    Library
                </a>

                <a href="/storieswriter"
                class="flex items-center gap-3 px-4 py-2 rounded-full bg-blue-900 text-white">
                    <span
                        class="iconify text-2xl"
                        data-icon="material-symbols:library-books-outline-rounded">
                    </span>
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
                            class="w-full border border-gray-300 rounded-full px-4 py-2
                                focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <span
                            class="iconify absolute right-3 top-1/2 -translate-y-1/2
                                text-gray-400 pointer-events-none text-2xl"
                            data-icon="ic:round-search">
                        </span>
                    </div>

                    <!-- Right Icons -->
                    <div class="flex items-center gap-4">

                        <!-- Write Icon -->
                        <a href="/writer/write">
                            <span
                                class="iconify text-blue-800 cursor-pointer text-4xl
                                    hover:text-blue-600 transition"
                                data-icon="jam:write">
                            </span>
                        </a>

                        <!-- Profile / Logout -->
                        <div onclick="document.getElementById('logout-form').submit()">
                            <span
                                class="iconify text-blue-800 cursor-pointer text-5xl
                                    hover:text-blue-600 transition"
                                data-icon="ic:round-account-circle">
                            </span>
                        </div>

                    </div>
                </div>

        <!-- Tabs -->
        <div class="flex gap-6 border-b border-gray-200 mb-4 text-blue-900 font-body">
            <button class="tab-btn border-b-2 border-blue-900 pb-1" data-tab="drafts">Drafts</button>
            <button class="tab-btn pb-1" data-tab="scheduled">Scheduled</button>
            <button class="tab-btn pb-1" data-tab="published">Published</button>
        </div>

        <!-- List Content -->
        <div>
            <!-- Drafts -->
            <div class="tab-panel" data-tab="drafts">
                <div class="flex flex-col gap-4">
                    @forelse($drafts as $draft)
                        <div class="flex items-center bg-white shadow-xl rounded-lg pr-6 py-0 gap-6 mb-2">
                            <!-- Picture (nyatu di card) -->
                            <div class="w-32 h-28 bg-gray-300 rounded-lg flex items-center justify-center text-gray-700 overflow-hidden">
                                @if($draft->cover_image)
                                    <img src="{{ $draft->cover_image }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>

                            <!-- Title & Description -->
                            <div class="flex-1">
                                <h3 class="mt-2 text-blue-900 font-bold text-2xl">{{ $draft->title ?: 'Untitled' }}</h3>
                                <p class="mt-2 text-sm text-blue-900 opacity-80 line-clamp-2">{{ strip_tags(substr($draft->content, 0, 100)) }}...</p>
                            </div>

                            <!-- Status -->
                            <div class="w-28 text-blue-900 text-sm text-center">
                                Draft
                            </div>

                            <!-- Actions -->
                          <a href="{{ url('/writer/write/' . $draft->id) }}" class="w-16 text-blue-900 hover:underline text-center">
                                Edit
                            </a>

                            <form action="/writer/stories/{{ $draft->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-16 text-blue-900 hover:underline text-center">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <p>No drafts yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Scheduled -->
            <div class="tab-panel hidden" data-tab="scheduled">
                <div class="flex flex-col gap-4">
                    @forelse($scheduled as $schedule)
                        <div class="flex items-center bg-white shadow-xl rounded-lg pr-6 py-0 gap-6">
                            <!-- Picture (nyatu di card) -->
                            <div class="w-32 h-28 bg-gray-300 rounded-lg flex items-center justify-center text-gray-700 overflow-hidden mt-2">
                                @if($schedule->cover_image)
                                    <img src="{{ $schedule->cover_image }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>

                            <!-- Title & Description -->
                            <div class="flex-1">
                                <h3 class="mt-2 text-blue-900 font-bold text-2xl">{{ $schedule->title }}</h3>
                                <p class="mt-2 text-sm text-blue-900 opacity-80 line-clamp-2">{{ strip_tags(substr($schedule->content, 0, 100)) }}...</p>
                                <p class="mt-4 mb-2 text-xs text-gray-500">Scheduled: {{ $schedule->scheduled_at ? \Carbon\Carbon::parse($schedule->scheduled_at)->format('M d, Y H:i') : 'Not set' }}</p>
                            </div>

                            <!-- Status -->
                            <div class="w-28 text-blue-900 text-sm text-center">
                                Scheduled
                            </div>

                            <!-- Actions -->
                          <a href="{{ url('/writer/write/' . $schedule->id) }}" class="w-16 text-blue-900 hover:underline text-center">
                                Edit
                            </a>

                            <form action="/writer/stories/{{ $schedule->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-16 text-blue-900 hover:underline text-center">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <p>No scheduled articles yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Published -->
            <div class="tab-panel hidden" data-tab="published">
                <div class="flex flex-col gap-4">
                    @forelse($published as $publish)
                        <div class="flex items-center bg-white shadow-xl rounded-lg pr-6 py-0 gap-6">
                            <!-- Picture (nyatu di card) -->
                            <div class="w-32 h-28 bg-gray-300 rounded-lg flex items-center justify-center text-gray-700 overflow-hidden mt-2">
                                @if($publish->cover_image)
                                    <img src="{{ $publish->cover_image }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>

                            <!-- Title & Description -->
                            <div class="flex-1">
                                <h3 class="mt-2 text-blue-900 font-bold text-2xl">{{ $publish->title }}</h3>
                                <p class="mt-2 text-sm text-blue-900 opacity-80 line-clamp-2">{{ strip_tags(substr($publish->content, 0, 100)) }}...</p>
                                <p class="mt-4 mb-2 text-xs text-gray-500">Published: {{ $publish->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Status -->
                            <div class="w-28 text-blue-900 text-sm text-center">
                                Published
                            </div>

                            <!-- Actions -->
                          <a href="{{ url('/writer/write/' . $publish->id) }}" class="w-16 text-blue-900 hover:underline text-center">
                                Edit
                            </a>

                            <form action="/writer/stories/{{ $publish->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-16 text-blue-900 hover:underline text-center">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <p>No published articles yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

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
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
</form>