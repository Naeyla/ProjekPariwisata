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
    style="background-image: url('/images/sea.jpg'); opacity: 0.7; "
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- CONTENT -->
    <div class="relative z-10 flex flex-col min-h-screen text-white">
        <div class="flex flex-col justify-center items-center flex-1 px-4">
    <!-- Login Box -->
    <div class="w-full max-w-sm bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        <!-- Sign In Title -->
        <h2 class="text-3xl font-bold mb-6 font-body text-white text-center">Sign In</h2>

        <!-- Form -->
        <form class="flex flex-col gap-4">
            <!-- Email Input -->
            <input 
                type="email" 
                placeholder="Email" 
                class="w-full p-3 rounded-md bg-white/20 text-white placeholder-white font-body focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >

            <!-- Password Input -->
            <input 
                type="password" 
                placeholder="Password" 
                class="w-full p-3 rounded-md bg-white/20 text-white placeholder-white font-body focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >

            <!-- Sign In Button -->
            <button 
                type="submit" 
                class="w-full py-3 mt-2 bg-blue-700 hover:bg-blue-800 rounded-md font-body font-semibold transition-colors"
            >
                Sign In
            </button>
        </form>

        <!-- Sign Up Link -->
        <p class="mt-4 text-center text-white font-body">
            Don't have any account yet? 
            <a href="/register" class="underline hover:text-blue-500">Sign Up</a>
        </p>
    </div>
</div>
</div>
</section>

</body>
</html>
