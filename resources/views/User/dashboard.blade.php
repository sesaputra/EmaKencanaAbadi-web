@extends('User.layouts.app')

@section('content')

<div class="flex flex-col lg:flex-row items-center justify-between mt-20 2xl:mt-32 gap-12 px-10 lg:px-32">

    <div class="w-full lg:w-3/5 space-y-6">
        <p class="text-gray-600 text-lg 2xl:text-xl">Selamat datang di website</p>
        <h1 class="text-4xl 2xl:text-5xl font-bold text-gray-900">Ema Kencana Abadi</h1>
        <p class="text-gray-700 text-base 2xl:text-lg leading-relaxed">
            Ema Kencana Abadi adalah perusahaan yang bergerak di bidang penyediaan material dan bahan bangunan
            untuk berbagai kebutuhan konstruksi, serta menyediakan layanan penyewaan excavator guna mendukung
            kelancaran proyek-proyek pembangunan Anda.
        </p>
    </div>
    <div class="hidden lg:block w-[300px] 2xl:w-[420px]">
        <img src="{{ asset('images/tukang_berdua.png') }}" alt="3D Human">
    </div>
</div>

{{-- Box Informasi Tambahan --}}
<div class="mt-20 px-10 lg:px-32">
    <div class="bg-white border border-blue-200 rounded-xl shadow-md p-6">
        <div class="flex items-center mb-3">
            <i class="fas fa-info-circle text-blue-500 text-2xl mr-3"></i>
            <h3 class="text-xl font-semibold text-gray-800">Informasi Tambahan</h3>
        </div>
        <p class="text-gray-600 text-base">
            Ema Kencana Abadi merupakan perusahaan yang bergerak di bidang penyediaan material dan bahan bangunan
            berkualitas untuk berbagai kebutuhan konstruksi. Selain itu, kami juga menyediakan layanan penyewaan
            excavator yang handal untuk mendukung kelancaran proyek pembangunan Anda. Dengan komitmen pada pelayanan
            terbaik dan kepercayaan pelanggan, Ema Kencana Abadi siap menjadi mitra dalam setiap tahap pembangunan Anda.
        </p>
    </div>
</div>


{{-- Detail fitur tambahan --}}
<div class="mt-20 px-10 lg:px-32">
    <div class="flex flex-col lg:flex-row gap-12 items-center justify-end">
        <!-- Gambar kiri agak ke tengah -->
        <div class="hidden lg:block w-[300px] 2xl:w-[420px] ml-16">
            <img src="{{ asset('images/tukang_gregaji.png') }}" alt="3D Human" class="w-full h-auto">
        </div>

        <!-- Semua box fitur di kanan -->
        <div class="w-full lg:w-3/4 max-w-[950px] ml-auto space-y-10">

            <!-- Box 1: Daftar Produk -->
            <a href="{{ route('product') }}" class="block bg-green-50 border border-green-300 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-cubes text-green-500 text-2xl mr-3"></i>
                    <h3 class="text-lg font-semibold text-green-800">Daftar Produk</h3>
                </div>
                <p class="text-green-700 text-base">
                    Fitur ini menampilkan daftar produk yang tersedia di Ema Kencana Abadi, mulai dari berbagai jenis material dan bahan
                    bangunan hingga layanan penyewaan excavator. Setiap produk disertai dengan informasi lengkap seperti nama produk,
                    spesifikasi, dan ketersediaan stok untuk memudahkan pelanggan dalam memilih kebutuhan konstruksi mereka.
                </p>
            </a>

            <!-- Box 2: Tentang Kami -->
            <a href="{{ route('about') }}" class="block bg-yellow-50 border border-yellow-300 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-building text-yellow-500 text-2xl mr-3"></i>
                    <h3 class="text-lg font-semibold text-yellow-800">Tentang Kami</h3>
                </div>
                <p class="text-yellow-700 text-base">
                    Ema Kencana Abadi merupakan perusahaan yang bergerak di bidang penyediaan material dan bahan bangunan serta penyewaan
                    excavator. Kami berkomitmen untuk memberikan layanan terbaik dan menjadi mitra terpercaya dalam mendukung proyek-proyek
                    konstruksi pelanggan kami.
                </p>
            </a>

            <!-- Box 3: Contact Person -->
            <a href="{{ route('contact') }}" class="block bg-blue-50 border border-blue-300 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-address-book text-blue-500 text-2xl mr-3"></i>
                    <h3 class="text-lg font-semibold text-blue-800">Contact Person</h3>
                </div>
                <p class="text-blue-700 text-base">
                    Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, silakan kunjungi halaman kontak kami.
                    Di sana Anda dapat menemukan detail kontak dan formulir untuk menghubungi tim Ema Kencana Abadi.
                </p>
            </a>
        </div>
    </div>
</div>

{{-- Galeri Kami --}}




@endsection