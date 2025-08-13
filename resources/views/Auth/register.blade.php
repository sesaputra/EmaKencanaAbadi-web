<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="relative min-h-screen bg-gray-100 overflow-hidden">

    <!-- Full Background with Blur -->
    <div class="absolute inset-0 bg-cover bg-center brightness-75 z-0"
        style="background-image: url('/image/foto_login.jpg');"></div>

    <!-- Content Layer -->
    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-5xl bg-white/70 backdrop-blur-xl border border-white/30 rounded-2xl shadow-lg overflow-hidden flex flex-col lg:flex-row">

            <!-- Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12">
                <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Register</h2>

                @if ($errors->any())
                <div class="bg-red-100 text-red-600 px-4 py-2 text-sm rounded mb-4">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <input name="name" type="text" placeholder="Full Name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>

                    <input name="email" type="email" placeholder="Email Address" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>

                    <input name="password" type="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>

                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition duration-300">
                        Register
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">
                            Login di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>