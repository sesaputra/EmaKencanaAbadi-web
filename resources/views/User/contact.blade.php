@extends('User.layouts.app')

@section('content')

{{-- Header Halaman --}}
<div class="flex justify-start">
    <div class="flex flex-col w-full lg:w-2/3 text-left mx-4 md:mx-10 lg:mx-20 lg:ml-28 mt-10">
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center text-base text-yellow-600 hover:text-yellow-800 font-medium transition duration-300 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Utama
        </a>
        <p class="text-sm md:text-base text-gray-600">Selamat datang di halaman</p>
        <p class="font-semibold text-2xl md:text-3xl my-2 text-gray-800">Kontak & Informasi Perusahaan</p>
        <div class="w-28 h-1 bg-yellow-500 rounded mb-4"></div>
        <p class="text-gray-600 text-sm md:text-base mb-3">Halaman ini memberikan informasi lengkap mengenai perusahaan, lokasi, dan media sosial UD. Ema Kencana Abadi.</p>
        <div class="flex items-start space-x-4 border-l-4 border-yellow-600 bg-yellow-50 rounded-md p-5 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 text-yellow-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
            </svg>
            <div>
                <h3 class="text-yellow-700 font-semibold text-base md:text-lg mb-1">Informasi Tambahan</h3>
                <p class="text-yellow-800 text-sm md:text-base leading-relaxed max-w-prose">
                    Anda dapat menemukan lokasi kami di peta, serta mengikuti akun media sosial untuk informasi terkini tentang layanan dan produk yang kami tawarkan.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Informasi Kontak --}}
<div class="mt-16 px-4 md:px-10 lg:px-20 xl:px-32">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
    <div class="space-y-4 text-gray-700 text-base md:text-lg mb-10">
        <p><strong>Alamat:</strong> C2RV+GQ4, Jl. Raya Tibubiu, Kerambitan, Tabanan, Bali 82161</p>
        <p><strong>No. Telepon:</strong> 0812-3456-7890</p>
        <p><strong>Email:</strong> info@emakencanaabadi.com</p>
    </div>

    {{-- Media Sosial --}}
    <div class="mt-12 text-center">
        <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Ikuti Kami di Media Sosial</h3>
        <div class="flex justify-center space-x-6">
            <!-- WhatsApp -->
            <a href="https://wa.me/6281234567890" target="_blank" class="text-green-600 hover:text-green-700 text-3xl">
                <i class="fab fa-whatsapp"></i>
            </a>
            <!-- Email -->
            <a href="mailto:info@emakencanaabadi.com" class="text-red-500 hover:text-red-600 text-3xl">
                <i class="fas fa-envelope"></i>
            </a>
            <!-- Instagram -->
            <a href="https://instagram.com/emakencanaabadi" target="_blank" class="text-pink-500 hover:text-pink-600 text-3xl">
                <i class="fab fa-instagram"></i>
            </a>
            <!-- Facebook -->
            <a href="https://facebook.com/emakencanaabadi" target="_blank" class="text-blue-600 hover:text-blue-700 text-3xl">
                <i class="fab fa-facebook"></i>
            </a>
        </div>
    </div>
</div>

{{-- Lokasi Map --}}
<div class="mt-20 px-4 md:px-10 lg:px-20 xl:px-32">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Lokasi Kami</h2>
    <div class="w-full h-[400px] rounded-md overflow-hidden shadow-lg border border-gray-200">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.386837845391!2d115.044442!3d-8.5587498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd231cf389124db%3A0x320f366a9f5ca56d!2sUD.%20Ema%20Kencana%20Abadi!5e0!3m2!1sid!2sid!4v1754450173209!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

@endsection