<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Ema Kencana Abadi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Font Awesome CDN v6.5.0 (recommended) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Libertinus+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Tambahkan di dalam <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            font-family: 'Libertinus Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white font-sans">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main wrapper dengan left padding sesuai lebar sidebar -->
    <div class="pl-64 flex flex-col h-screen">

        <!-- Navbar (tetap di atas) -->
        <div class="fixed top-0 left-64 right-0 z-30">
            @include('admin.layouts.navbar')
        </div>

        <!-- Konten utama scrollable -->
        <main class="flex-1 mt-20 mb-16 overflow-y-auto px-4 bg-white">
            @yield('content')
        </main>

        <!-- Footer (tetap di bawah) -->
        <div class="fixed bottom-0 left-64 right-0 z-30">
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        function updateBaliTime() {
            const optionsTime = {
                timeZone: 'Asia/Makassar', // WITA, berlaku juga untuk Bali
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
            };

            const optionsDate = {
                timeZone: 'Asia/Makassar',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            };

            const now = new Date();
            document.getElementById('bali-time').textContent = now.toLocaleTimeString('id-ID', optionsTime);
            document.getElementById('bali-date').textContent = now.toLocaleDateString('id-ID', optionsDate);
        }

        setInterval(updateBaliTime, 1000);
        updateBaliTime();
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>


</body>

</html>