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
        <nav class="flex flex-col gap-3">
            <a href="/homepageadmin" class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-gray-100">
                <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon home">
                Home
            </a>
            <a href="/libraryadmin" class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-gray-100">
                <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon library">
                Library
            </a>
            <a href="/managementadmin" class="flex items-center gap-2 px-3 py-2 rounded-full bg-blue-900 text-white">
                <img src="/mnt/data/eca25925-1e87-48f2-b108-44483cf14fc1.png" class="w-5 h-5" alt="icon library">
                Management
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
        <div class="flex gap-6 border-b border-gray-200 mb-4 font-body">
            <a href="/managementadmin?tab=articles"
            class="pb-3 transition
            {{ $tab === 'articles'
                    ? 'text-blue-900 font-bold border-b-2 border-blue-900'
                    : 'text-slate-500 hover:text-blue-900' }}">
                Article
            </a>

            <a href="/managementadmin?tab=comments"
            class="pb-3 transition
            {{ $tab === 'comments'
                    ? 'text-blue-900 font-bold border-b-2 border-blue-900'
                    : 'text-slate-500 hover:text-blue-900' }}">
                Comments
            </a>

            <a href="/managementadmin?tab=users"
            class="pb-3 transition
            {{ $tab === 'users'
                    ? 'text-blue-900 font-bold border-b-2 border-blue-900'
                    : 'text-slate-500 hover:text-blue-900' }}">
                Users
            </a>
        </div>

        <!-- List Content -->
        <div>
            <!-- Articles -->
            @if ($tab === 'articles')
            <div class="bg-linear-to-br from-blue-900 to-blue-800 p-6 rounded-2xl shadow-lg">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-6">
                    <span class="text-blue-200 text-sm">
                        Total: {{ $articles->total() }} artikel
                    </span>

                    <!-- FILTER -->
                    <form method="GET">
                        <input type="hidden" name="tab" value="articles">
                        <select name="type"
                            onchange="this.form.submit()"
                            class="px-4 py-2 rounded-xl text-sm border border-slate-300">
                            <option value="">Semua Jenis</option>
                            <option value="sungai" {{ request('type')=='sungai'?'selected':'' }}>Sungai</option>
                            <option value="pantai" {{ request('type')=='pantai'?'selected':'' }}>Pantai</option>
                            <option value="danau"  {{ request('type')=='danau'?'selected':'' }}>Danau</option>
                        </select>
                    </form>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Judul</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Cover</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($articles as $article)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4">{{ $article->id }}</td>
                                <td class="px-6 py-4 font-medium">{{ $article->title }}</td>
                                <td class="px-6 py-4 capitalize">{{ $article->type }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ $article->cover_image }}" class="w-14 h-14 rounded-lg object-cover">
                                </td>
                                <td class="px-6 py-4 flex gap-3 items-center">
                                    <a class="text-blue-600">👁</a>
                                    <a class="text-yellow-600">✏</a>
                                    <form method="POST" action="{{ route('managementadmin.article.destroy', $article) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline cursor-pointer bg-transparent border-0 p-0">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-6 text-slate-300">Tidak ada artikel</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $articles->links() }}</div>
            </div>
            @endif

            <!-- Comments -->  
            @if ($tab === 'comments')
            <div class="bg-linear-to-br from-blue-900 to-blue-800 p-6 rounded-2xl shadow-lg">

                <div class="flex items-center justify-between mb-6">
                    <span class="text-blue-200 text-sm">
                        Total: {{ $comments->total() }} komentar
                    </span>

                    <!-- FILTER -->
                    <form method="GET">
                        <input type="hidden" name="tab" value="comments">
                        <select name="type"
                            onchange="this.form.submit()"
                            class="px-4 py-2 rounded-xl text-sm border border-slate-300">
                            <option value="">Semua Jenis Artikel</option>
                            <option value="sungai" {{ request('type')=='sungai'?'selected':'' }}>Sungai</option>
                            <option value="pantai" {{ request('type')=='pantai'?'selected':'' }}>Pantai</option>
                            <option value="danau" {{ request('type')=='danau'?'selected':'' }}>Danau</option>
                        </select>
                    </form>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Artikel</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Komentar</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($comments as $comment)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4">{{ $comment->id_comment }}</td>
                                <td class="px-6 py-4">{{ $comment->article->title }}</td>
                                <td class="px-6 py-4 capitalize">{{ $comment->article->type }}</td>
                                <td class="px-6 py-4">{{ $comment->user->name ?? 'Anonim' }}</td>
                                <td class="px-6 py-4 line-clamp-2">{{ $comment->comment }}</td>
                                <td class="px-6 py-4">
                                    <button class="text-red-600">🗑</button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-6 text-slate-300">Tidak ada komentar</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $comments->links() }}</div>
            </div>
            @endif

            <!-- Users -->  
            @if ($tab === 'users')
            <div class="bg-linear-to-br from-blue-900 to-blue-800 p-6 rounded-2xl shadow-lg">

                <div class="flex items-center justify-between mb-6">
                    <span class="text-blue-200 text-sm">
                        Total: {{ $users->total() }} pengguna
                    </span>

                    <!-- FILTER -->
                    <form method="GET">
                        <input type="hidden" name="tab" value="users">
                        <select name="role"
                            onchange="this.form.submit()"
                            class="px-4 py-2 rounded-xl text-sm border border-slate-300">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                            <option value="writer" {{ request('role')=='writer'?'selected':'' }}>Writer</option>
                            <option value="user" {{ request('role')=='user'?'selected':'' }}>Pengguna</option>
                        </select>
                    </form>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Username</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($users as $user)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4">{{ $user->id_user }}</td>
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->role !== 'admin')
                                    <form method="POST" action="{{ route('managementadmin.user.destroy', $user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline cursor-pointer bg-transparent border-0 p-0">🗑</button>
                                    </form>
                                    @else
                                    <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-6 text-slate-300">Tidak ada pengguna</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $users->links() }}</div>
            </div>
            @endif
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