<nav class="bg-white shadow-md border-b border-gray-200 font-sans" style="font-family: 'Libertinus Sans', sans-serif;">
  <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">

    <!-- Logo -->
    <a href="#" class="flex items-center space-x-3" aria-label="Ema Kencana Abadi">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="1" width="7" height="12" />
        <rect x="3" y="17" width="7" height="6" />
        <rect x="14" y="1" width="7" height="6" />
        <rect x="14" y="11" width="7" height="12" />
      </svg>
      <span class="text-2xl font-bold text-gray-800 tracking-tight">Ema Kencana Abadi</span>
    </a>

    <!-- Navigation Links -->
    <ul class="hidden md:flex items-center space-x-8 text-lg font-medium">
      <li>
        <a href="{{ route('dashboard') }}"
          class="text-gray-600 hover:text-black border-b-2 {{ request()->routeIs('dashboard') ? 'border-black' : 'border-transparent' }} hover:border-black transition-all duration-200">
          Home
        </a>
      </li>
      <li>
        <a href="{{ route('about') }}"
          class="text-gray-600 hover:text-black border-b-2 {{ request()->routeIs('about') ? 'border-black' : 'border-transparent' }} hover:border-black transition-all duration-200">
          About
        </a>
      </li>
      <li>
        <a href="{{ route('product') }}"
          class="text-gray-600 hover:text-black border-b-2 {{ request()->routeIs('product') ? 'border-black' : 'border-transparent' }} hover:border-black transition-all duration-200">
          Product
        </a>
      </li>
      <li>
        <a href="{{ route('contact') }}"
          class="text-gray-600 hover:text-black border-b-2 {{ request()->routeIs('contact') ? 'border-black' : 'border-transparent' }} hover:border-black transition-all duration-200">
          Contact
        </a>
      </li>
    </ul>

    <!-- User Menu -->
    <div class="flex items-center space-x-4">
      @auth
      <div class="flex items-center gap-2">
        <img class="w-9 h-9 rounded-full border object-cover"
          src="{{ asset(Auth::user()->photo) }}"
          alt="{{ Auth::user()->name }} photo" />
        <span class="text-gray-700 text-xl">{{ Auth::user()->name }}</span>
      </div>
      @else
      <a href="{{ route('login') }}" class="text-base font-semibold tracking-wide text-white bg-emerald-500 hover:bg-emerald-600 px-6 py-2 rounded-full shadow-sm transition duration-200">
        Login
      </a>
      @endauth
    </div>
  </div>
</nav>
