<!--  -->

<!-- Header -->
<header class="h-20 bg-white shadow flex items-center justify-between px-8 border-b border-gray-200">
    <h1 class="text-3xl font-bold tracking-wide text-gray-800">Dashboard Admin</h1>

    <div class="flex items-center gap-6">
        @auth
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.42 0-8 2.015-8 4.5V20h16v-1.5c0-2.485-3.58-4.5-8-4.5z" />
                </svg>
                <span class="text-gray-700">{{ Auth::user()->name ?? 'Guest' }}</span>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>
