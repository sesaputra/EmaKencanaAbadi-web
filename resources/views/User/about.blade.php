@extends('User.layouts.app')

@section('content')

{{-- About Ema Kencana Abadi --}}
<div class="mt-10 px-4 md:px-10 lg:px-20 xl:px-32">
    <div class="flex flex-col w-full lg:w-2/3 text-left">
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center text-base text-yellow-600 hover:text-yellow-800 font-medium transition duration-300 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Utama
        </a>

        <p class="text-lg text-gray-600">Tentang Kami</p>
        <h1 class="font-semibold text-3xl 2xl:text-4xl my-2 text-gray-800">Ema Kencana Abadi</h1>
        <div class="w-28 h-1 bg-yellow-500 rounded mb-6"></div>

        <p class="text-gray-700 text-lg leading-relaxed mb-8">
            Ema Kencana Abadi adalah perusahaan yang bergerak di bidang penyediaan material bangunan dan layanan konstruksi.
            Kami berkomitmen untuk menyediakan produk berkualitas tinggi serta pelayanan terbaik untuk kebutuhan proyek bangunan Anda —
            mulai dari rumah tinggal, gedung perkantoran, hingga proyek infrastruktur lainnya.
        </p>

        <div class="flex items-start space-x-4 border-l-4 border-yellow-600 bg-yellow-50 rounded-md p-6 mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17l-4.5-4.5L9.75 8m4.5 0l4.5 4.5-4.5 4.5" />
            </svg>
            <div>
                <h3 class="text-yellow-700 font-semibold text-xl mb-2">Visi & Layanan Kami</h3>
                <p class="text-yellow-800 text-base leading-relaxed">
                    Dengan pengalaman dan dedikasi tinggi, kami menghadirkan layanan pengiriman material tepat waktu,
                    konsultasi proyek, serta solusi konstruksi yang andal dan efisien.
                </p>
            </div>
        </div>
    </div>
</div>

<div
    x-data="{ open: false, modalImg: '', modalDesc: '' }"
    class="mt-24 px-10 lg:px-32">
    <div class="text-center mb-10">
        <h2 class="text-2xl 2xl:text-3xl font-bold text-gray-900">Galeri Kami</h2>
        <p class="text-gray-600 mt-2 text-base 2xl:text-lg">
            Dokumentasi kegiatan, produk, dan layanan Ema Kencana Abadi
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($kegiatan as $item)
        <div class="overflow-hidden rounded-xl shadow-md bg-white cursor-pointer"
            @click="open = true; modalImg = '{{ asset('storage/' . $item->gambar) }}'; modalDesc = '{{ $item->judul }}'">
            <img src="{{ asset('storage/' . $item->gambar) }}"
                alt="{{ $item->judul }}"
                class="w-full h-60 object-cover hover:scale-105 transition-transform duration-300">
            <p class="p-4 text-gray-700 text-sm font-medium text-center">{{ $item->judul }}</p>
        </div>
        @endforeach
    </div>

    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm bg-black/60"
        style="display: none;" {{-- Tambahkan ini --}}
        @click.away="open = false" {{-- Opsional: Menutup modal saat klik di luar area modal --}}
    >
        <div
            x-show="open"
            x-transition.scale
            class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 sm:mx-6 lg:mx-0 p-6">
            <button
                @click="open = false"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition-all duration-300 text-4xl font-bold leading-none"
                aria-label="Close">
                &times;
            </button>

            <div class="flex flex-col items-center">
                <img
                    :src="modalImg"
                    alt="Preview"
                    class="rounded-xl shadow-md max-h-[500px] object-contain mb-4">
                <p
                    class="text-gray-800 text-lg font-medium text-center"
                    x-text="modalDesc"></p>
            </div>
        </div>
    </div>
</div>

@endsection