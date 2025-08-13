@extends('Admin.layouts.app')

@section('content')
<div class="flex flex-col w-full mx-auto mt-6 mb-12 px-4 lg:px-12">

    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk</h2>
        <button onclick="openAddModal()"
            class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Produk
        </button>
    </div>

    {{-- Tabel Daftar Produk --}}
    @if ($products->count())
    <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-base text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider text-sm">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Gambar</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama Produk</th>
                        <th class="px-6 py-4 text-left font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 text-left font-semibold">Harga</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk"
                                class="w-20 h-20 object-cover rounded-lg border border-gray-200 shadow">
                            @else
                            <span class="text-gray-400 italic text-sm">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 max-w-lg truncate" title="{{ $product->description }}">{{ $product->description }}</td>
                        <td class="px-6 py-4 text-green-600 font-bold">
                            {{ 'Rp ' . number_format((int) $product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-3">
                                <button onclick="openEditModal('{{ json_encode($product) }}')"
                                    class="p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md hover:bg-yellow-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="text-center p-8 bg-white rounded-xl shadow-lg border border-gray-200">
        <p class="text-gray-500 text-lg">Belum ada produk yang ditambahkan.</p>
    </div>
    @endif
</div>

---

{{-- Modal Tambah --}}
<div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg transform transition-transform duration-300 scale-95">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h3>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Harga <span class="text-red-500">*</span></label>
                <input type="text" id="price" name="price" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="Contoh: 5000000" required>
                <p class="text-xs text-gray-500 mt-1">Masukkan nominal angka saja, tanpa titik atau simbol. Misal: 5000000</p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" rows="3"></textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Gambar <span class="text-red-500">*</span></label>
                <input type="file" id="image" name="image" class="w-full border border-gray-300 rounded-lg px-4 py-2 transition" required>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="px-6 py-2 text-gray-600 bg-gray-200 rounded-lg font-medium hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

---

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg transform transition-transform duration-300 scale-95">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Edit Produk</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="editName" class="block text-gray-700 font-medium mb-2">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="editName" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
            </div>

            <div class="mb-4">
                <label for="editPrice" class="block text-gray-700 font-medium mb-2">Harga <span class="text-red-500">*</span></label>
                <input type="text" name="price" id="editPrice" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                <p class="text-xs text-gray-500 mt-1">Masukkan nominal angka saja, tanpa titik atau simbol. Misal: 5000000</p>
            </div>

            <div class="mb-4">
                <label for="editDescription" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="description" id="editDescription" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" rows="3"></textarea>
            </div>

            <div class="mb-6">
                <label for="editImage" class="block text-gray-700 font-medium mb-2">Gambar</label>
                <input type="file" id="editImage" name="image" class="w-full border border-gray-300 rounded-lg px-4 py-2 transition">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2 text-gray-600 bg-gray-200 rounded-lg font-medium hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">Perbarui</button>
            </div>
        </form>
    </div>
</div>

---

<script>
    // Fungsi untuk membuka modal Tambah
    function openAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex', 'opacity-100');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }

    // Fungsi untuk menutup modal Tambah
    function closeAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('flex', 'opacity-100');
        modal.classList.add('hidden');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
    }

    // Fungsi untuk membuka modal Edit
    function openEditModal(productJson) {
        const product = JSON.parse(productJson);
        const form = document.getElementById('editForm');
        form.action = `/admin/product/update/${product.id}`;
        document.getElementById('editName').value = product.name;
        document.getElementById('editPrice').value = product.price;
        document.getElementById('editDescription').value = product.description;
        
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex', 'opacity-100');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }

    // Fungsi untuk menutup modal Edit
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('flex', 'opacity-100');
        modal.classList.add('hidden');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
    }

    // Panggil modal Tambah jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            const isAddModalError = "{{ $errors->has('name') || $errors->has('price') || $errors->has('image') }}";
            if (isAddModalError) {
                openAddModal();
            }
        @endif
    });
</script>
@endsection