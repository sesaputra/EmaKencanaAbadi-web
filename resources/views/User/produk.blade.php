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
        <h1 class="font-bold text-3xl md:text-4xl my-2 text-gray-800">Daftar Produk</h1>
        <div class="w-32 h-1 bg-yellow-500 rounded mb-4"></div>
        <p class="text-gray-600 text-sm md:text-base mb-3">
            Halaman ini berisi daftar lengkap produk dan layanan dari UD. Ema Kencana Abadi, termasuk bahan bangunan dan alat berat seperti excavator.
        </p>

        <div class="flex items-start space-x-4 border-l-4 border-yellow-600 bg-yellow-50 rounded-md p-5 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 text-yellow-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
            </svg>
            <div>
                <h3 class="text-yellow-700 font-semibold text-base md:text-lg mb-1">Informasi Tambahan</h3>
                <p class="text-yellow-800 text-sm md:text-base leading-relaxed max-w-prose">
                    Anda dapat menemukan lokasi kami di peta, serta mengikuti akun media sosial untuk info terbaru seputar produk dan layanan kami.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Produk --}}
<div
    x-data="{ open: false, modalImg: '', modalName: '', modalDesc: '', modalPrice: '' }"
    class="mt-16 px-6 md:px-10 lg:px-32"
>
    <div class="text-center mb-10">
        <h2 class="text-2xl 2xl:text-3xl font-bold text-gray-900">Produk Unggulan Kami</h2>
        <p class="text-gray-600 mt-2 text-base 2xl:text-lg">
            Berikut beberapa produk yang tersedia di UD. Ema Kencana Abadi
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div
            class="cursor-pointer bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition duration-300"
            @click="open = true;
                    modalImg = '{{ asset('storage/' . $product->image) }}';
                    modalName = `{{ $product->name }}`;
                    modalDesc = `{{ $product->description }}`;
                    modalPrice = `{{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Harga tidak tersedia' }}`;"
        >
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-full h-48 object-cover rounded-t-xl">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 50) }}</p>
                <p class="text-green-600 font-semibold text-sm">
                    {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Harga tidak tersedia' }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center"
        style="display: none;" {{-- Tambahkan ini untuk memastikan modal tersembunyi secara default --}}
        @click.away="open = false" {{-- Opsional: Menutup modal saat mengklik di luar area modal --}}
    >
        <div
            x-show="open"
            x-transition.scale
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 p-6 relative"
        >
            <button @click="open = false"
                class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-3xl font-bold leading-none"
                aria-label="Close">
                &times;
            </button>

            <img :src="modalImg" alt="Preview" class="w-full h-64 object-cover rounded-xl mb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-2" x-text="modalName"></h3>
            <p class="text-gray-600 mb-3" x-text="modalDesc"></p>
            <p class="text-green-600 font-bold text-lg" x-text="modalPrice"></p>
        </div>
    </div>
</div>

@endsection