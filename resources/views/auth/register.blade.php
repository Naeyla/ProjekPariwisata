<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KisahOmbak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Island+Moments&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        logo: ['Great Vibes', 'cursive'],
                        headline: ['Island Moments', 'cursive'],
                        body: ['Libre Baskerville', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-body bg-black text-white">

<section
    class="min-h-screen bg-cover bg-center relative"
    style="background-image: url('/images/sea.jpg'); opacity: 0.7; "
>
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative z-10 flex flex-col min-h-screen text-white">
        <div class="flex flex-col justify-center items-center flex-1 px-4">
    <div class="w-full max-w-sm bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        <h2 class="text-3xl font-bold mb-6 font-body text-white text-center">Sign Up</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-500/80 text-white rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-500/80 text-white rounded-md text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            <input
                type="text"
                name="username"
                placeholder="Username"
                value="{{ old('username') }}"
                class="w-full p-3 rounded-md bg-white/20 text-white placeholder-white font-body focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-2 border-red-500 @enderror"
                required
            >
            @error('username')
                <span class="text-red-300 text-sm">{{ $message }}</span>
            @enderror

            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                class="w-full p-3 rounded-md bg-white/20 text-white placeholder-white font-body focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-2 border-red-500 @enderror"
                required
            >
            @error('email')
                <span class="text-red-300 text-sm">{{ $message }}</span>
            @enderror

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="w-full p-3 rounded-md bg-white/20 text-white placeholder-white font-body focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-2 border-red-500 @enderror"
                required
            >
            @error('password')
                <span class="text-red-300 text-sm">{{ $message }}</span>
            @enderror

            <button
                type="submit"
                class="w-full py-3 mt-2 bg-blue-700 hover:bg-blue-800 rounded-md font-body font-semibold transition-colors"
            >
                Sign Up
            </button>
        </form>

        <p class="mt-4 text-center text-white font-body">
            Sudah punya akun?
            <a href="/login" class="underline hover:text-blue-500">Sign In</a>
        </p>

    </div>
</div>
</div>
</section>

</body>
</html>
