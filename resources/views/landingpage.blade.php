<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KisahOmbak</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
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

<!-- HERO SECTION -->
<section
    class="min-h-screen bg-cover bg-center relative"
    style="background-image: url('/images/sea.jpg');  opacity: 0.8;"
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- CONTENT -->
    <div class="relative z-10 flex flex-col min-h-screen text-white">

        <!-- NAVBAR -->
        <nav class="flex items-center justify-between px-10 py-6">
            <h1 class="font-logo text-4xl tracking-wide">
                KisahOmbak
            </h1>

            <div class="flex items-center gap-10 text-sm">
                <a href="#" class="hover:underline">Our Story</a>
                <a href="#" class="hover:underline">Write</a>

                <a href="/login"
                   class="bg-white text-blue-900 px-6 py-2 rounded-full hover:bg-blue-800 hover:text-white transition">
                    Sign In
                </a>
            </div>
        </nav>

        <!-- HERO CONTENT -->
        <div class="flex flex-1 items-center px-16">
        <div class="flex-1 text-right pr-10">
        <h2 class="font-headline text-[5rem] leading-tight">
            Lost at Sea,<br>
            We Were<br>
            Born to be<br>
            Free.
        </h2>

       <!-- Tombol di bawah teks -->
        <a href="{{ url('/login') }}">
            <button
                class="mt-10 bg-white text-blue-900 px-10 py-3 rounded-full text-sm hover:bg-blue-800 hover:text-white transition">
                Start Reading
            </button>
        </a>
    </div>
</div>
</section>


</body>
</html>
