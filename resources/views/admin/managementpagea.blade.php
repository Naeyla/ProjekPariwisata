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
                <a href="/homepageadmin"
                class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-100 text-blue-800">
                    <span
                        class="iconify text-xl"
                        data-icon="iconamoon:home-bold">
                    </span>
                    Home
                </a>

                <a href="/libraryadmin"
                class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-100 text-blue-800">
                    <span
                        class="iconify text-xl"
                        data-icon="solar:library-linear">
                    </span>
                    Library
                </a>

                <a href="/managementadmin"
                class="flex items-center gap-3 px-4 py-2 rounded-full bg-blue-900 text-white">
                    <span
                        class="iconify text-xl"
                        data-icon="solar:folder-with-files-outline">
                    </span>
                    Management
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
                    <span
                        class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-2xl"
                        data-icon="ic:round-search">
                    </span>
                </div>
                <div class="flex items-center gap-4">
                    <div onclick="document.getElementById('logout-form').submit()">
                        <span
                            class="iconify text-blue-800 cursor-pointer text-5xl hover:text-blue-600 transition"
                            data-icon="ic:round-account-circle">
                        </span>
                    </div>
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
                    <span class="text-blue-800 text-sm">
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
                                    <img src="{{ asset($article->cover_image) }}" class="w-14 h-14 rounded-lg object-cover">
                                </td>
                                <td class="px-6 py-4 flex gap-4 items-center">

                                <!-- DETAIL -->
                                <button
                                    class="text-blue-600 hover:underline"
                                    data-title="{{ $article->title }}"
                                    data-image="{{ asset($article->cover_image) }}"
                                    data-content="{!! nl2br(e($article->content)) !!}"
                                    onclick="openArticleModal(this)">
                                    <span class="iconify text-xl" data-icon="ic:round-remove-red-eye"></span> 
                                </button>

                                <!-- EDIT -->
                                <button
                                    onclick="openEditModal(
                                        {{ $article->id }},
                                        '{{ e($article->title) }}',
                                        '{{ e($article->type) }}',
                                        '{{ e($article->cover_image) }}',
                                        `{{ e($article->content) }}`
                                    )"
                                    class="text-blue-700 hover:text-blue-900 transition"
                                    title="Edit artikel">
                                    <span class="iconify text-xl" data-icon="mdi:pencil-outline"></span>
                                </button>

                                <!-- DELETE -->
                                <form method="POST"
                                    action="{{ route('managementadmin.article.destroy', $article) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition"
                                            title="Hapus artikel">
                                            <span class="iconify text-xl" data-icon="mdi:trash-can-outline"></span>
                                    </button>
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
                    <span class="text-blue-800 text-sm">
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
                    <span class="text-blue-800 text-sm">
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
                                <td class="px-6 py-4">{{ $user->id }}</td>
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                                <td class="px-6 py-4 flex items-center gap-4">
                                <!-- Edit -->
                                <button
                                    type="button"
                                    onclick="openUserEditModal(
                                        '{{ $user->id }}',
                                        '{{ $user->username }}',
                                        '{{ $user->email }}',
                                        `{{ $user->role }}`
                                    )"
                                    class="text-blue-700 hover:text-blue-900 transition"
                                    title="Edit user">
                                    <span class="iconify text-xl" data-icon="mdi:pencil-outline"></span>
                                </button>

                                <!-- Delete -->
                                <form method="POST"
                                    action="{{ route('managementadmin.user.destroy', $user) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800 transition"
                                        title="Hapus user">
                                        <span class="iconify text-xl" data-icon="mdi:trash-can-outline"></span>
                                    </button>
                                </form>
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

        <!-- Modal Detail Artikel -->
        <div
            id="articleModal"
            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

            <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 relative">
                <!-- Close -->
                <button
                    onclick="closeArticleModal()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">
                    &times;
                </button>

                <!-- Image -->
                <img
                    id="modalImage"
                    src=""
                    alt=""
                    class="w-full h-64 object-cover rounded-xl mb-4">

                <!-- Title -->
                <h2
                    id="modalTitle"
                    class="text-2xl font-bold text-blue-800 mb-4">
                </h2>

                <!-- Content -->
                <div
                    id="modalContent"
                    class="text-gray-700 leading-relaxed space-y-3">
                </div>
            </div>
        </div>

            </main>
        </div>

        <!-- Modal Edit Artikel -->
        <div
            id="editArticleModal"
            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

            <div class="bg-white rounded-2xl w-full max-w-2xl p-6 relative">
                <!-- Close -->
                <button
                    onclick="closeEditModal()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">
                    &times;
                </button>

                <h2 class="text-2xl font-bold text-blue-800 mb-4">
                    Edit Artikel
                </h2>

                <form
                    id="editArticleForm"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="text-sm font-medium">Judul</label>
                        <input
                            type="text"
                            name="title"
                            id="editTitle"
                            class="w-full border rounded-xl px-4 py-2">
                    </div>

                    <!-- Jenis -->
                    <div class="mb-3">
                        <label class="text-sm font-medium">Jenis</label>
                        <select
                            name="type"
                            id="editType"
                            class="w-full border rounded-xl px-4 py-2">
                            <option value="pantai">Pantai</option>
                            <option value="sungai">Sungai</option>
                            <option value="danau">Danau</option>
                        </select>
                    </div>

                    <!-- Cover -->
                    <div class="mb-3">
                        <label class="text-sm font-medium">Cover Image</label>
                        <input
                            type="text"
                            name="cover_image"
                            id="editCover"
                            class="w-full border rounded-xl px-4 py-2">
                    </div>

                    <!-- Konten -->
                    <div class="mb-4">
                        <label class="text-sm font-medium">Konten</label>
                        <textarea
                            name="content"
                            id="editContent"
                            rows="5"
                            class="w-full border rounded-xl px-4 py-2"></textarea>
                    </div>

                    <!-- Button -->
                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            onclick="closeEditModal()"
                            class="px-4 py-2 border rounded-xl">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-900 text-white rounded-xl hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit User -->
        <div
            id="editUserModal"
            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
            onclick="closeUserModal()">

            <div
                class="bg-white w-full max-w-md rounded-2xl p-6 relative"
                onclick="event.stopPropagation()">

                <!-- Close -->
                <button
                    onclick="closeUserModal()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">
                    <span class="iconify" data-icon="ic:round-close"></span>
                </button>

                <h2 class="text-xl font-bold text-blue-900 mb-4">
                    Edit User
                </h2>

                <form
                    id="editUserForm"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="text-sm">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="editUsername"
                            class="w-full border rounded-xl px-3 py-2">
                    </div>

                    <div class="mb-3">
                        <label class="text-sm">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="editEmail"
                            class="w-full border rounded-xl px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="text-sm">Role</label>
                        <select
                            name="role"
                            id="editRole"
                            class="w-full border rounded-xl px-3 py-2">
                            <option value="admin">Admin</option>
                            <option value="writer">Writer</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            onclick="closeUserModal()"
                            class="px-4 py-2 border rounded-xl">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-900 text-white rounded-xl">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
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
<script>
function openArticleModal(el) {
    document.getElementById('modalTitle').innerText = el.dataset.title;
    document.getElementById('modalImage').src = el.dataset.image;
    document.getElementById('modalContent').innerHTML = el.dataset.content;

    const modal = document.getElementById('articleModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeArticleModal() {
    const modal = document.getElementById('articleModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<script>
    function openEditModal(id, title, type, cover, content) {
        document.getElementById('editTitle').value = title;
        document.getElementById('editType').value = type;
        document.getElementById('editCover').value = cover;
        document.getElementById('editContent').value = content;

        const form = document.getElementById('editArticleForm');
        form.action = `/managementadmin/article/${id}`;

        const modal = document.getElementById('editArticleModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editArticleModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
<script>
    function openUserEditModal(id, username, email, role) {
    console.log('Modal triggered', id, username, email, role); // <-- cek ini dulu
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;

        const form = document.getElementById('editUserForm');
        form.action = `/managementadmin/user/${id}`;

        const modal = document.getElementById('editUserModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserModal() {
        const modal = document.getElementById('editUserModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
</form>