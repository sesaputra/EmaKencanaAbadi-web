<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen relative flex items-center justify-center px-4 overflow-hidden">

    <!-- Background Image + Blur -->
    <div class="absolute inset-0 bg-cover bg-center brightness-75 z-0"
        style="background-image: url('/image/foto_login.jpg');"></div>

    <!-- Form Login -->
    <div class="relative z-10 w-full max-w-sm bg-white/60 backdrop-blur-md rounded-xl shadow-xl p-8">
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Login</h2>

        @if($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 text-sm rounded mb-4">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none"
                required autofocus>

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none"
                required>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition duration-300">
                Login
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                Belum punya akun?
                <a href="{{ route('register.form') }}" class="text-indigo-500 hover:underline">
                    Daftar di sini
                </a>
            </p>
        </form>
    </div>
</body>

</html>
