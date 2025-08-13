@extends('Admin.layouts.app')

@section('content')

<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 mt-8">
    <!-- Jumlah Akun Terdaftar -->
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase font-medium">Akun Terdaftar</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ $jumlahUser }}</h2>
            </div>
            <div class="bg-sky-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5.121 17.804A9.004 9.004 0 0112 3a9 9 0 016.879 14.804M12 12v3m0 4h.01" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Jumlah Produk -->
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase font-medium">Produk Tersedia</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ $jumlahProduk }}</h2>
            </div>
            <div class="bg-emerald-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3h18v4H3zM3 9h18v4H3zM3 15h18v4H3z" />
                </svg>
            </div>
        </div>
    </div>


    <!-- Tanggal & Waktu Bali -->
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 uppercase font-medium">Waktu Tabanan Bali</p>
                <h2 id="bali-time" class="text-xl font-bold text-gray-800">Loading...</h2>
                <p id="bali-date" class="text-sm text-gray-600"></p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M12 6v6l4 2M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
            </div>
        </div>
    </div>
</section>

<div class="bg-white rounded-lg shadow p-6 mb-6 max-w-lg">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">User Terdaftar per Bulan</h2>
    <div class="w-full h-48">
        <canvas id="userChart"></canvas>
    </div>
</div>

<script>
    const userChart = new Chart(document.getElementById('userChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah User',
                data: {!! $userCounts !!}, // Inject dari controller
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
</script>

@endsection