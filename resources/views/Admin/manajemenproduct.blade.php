@extends('Admin.layouts.app')

@section('content')
{{-- Tabel Daftar Produk --}}
<div class="flex flex-col w-full mx-auto mt-6 mb-12 px-4 lg:px-12">

    {{-- Tombol Tambah Produk --}}
    <div class="flex justify-end mb-4">
        <button onclick="openAddModal()"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-br from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Produk
        </button>
    </div>

    @if ($products->count())
    <h2 class="text-xl font-bold text-gray-800 mb-3">Daftar Produk</h2>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow mb-10">
        <table class="min-w-full text-base text-gray-700 divide-y divide-gray-200">
            <thead class="bg-gray-50 text-gray-600 uppercase tracking-wider text-sm">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Gambar</th>
                    <th class="px-6 py-4 text-left font-semibold">Nama Produk</th>
                    <th class="px-6 py-4 text-left font-semibold">Deskripsi</th>
                    <th class="px-6 py-4 text-left font-semibold">Harga</th>
                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($products as $product)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk"
                            class="w-16 h-16 object-cover rounded-md border">
                        @else
                        <span class="text-gray-400 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 max-w-xl truncate" title="{{ $product->description }}">{{ $product->description }}</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">
                        {{ 'Rp ' . number_format((int) $product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center gap-2 flex-wrap">
                            <button onclick="openEditModal({{ json_encode($product) }})"
                                class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded hover:bg-yellow-300 transition">
                                Edit
                            </button>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-semibold text-white bg-red-600 rounded hover:bg-red-700 transition"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- Modal Tambah --}}
<div id="addModal" class="fixed inset-0 backdrop-blur-md bg-white/10 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h3 class="text-xl font-semibold mb-4">Tambah Produk</h3>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Nama Produk</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Harga</label>
                <input type="number" name="price" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Gambar</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 text-gray-600 hover:text-gray-900">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 backdrop-blur-md bg-white/10 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h3 class="text-xl font-semibold mb-4">Edit Produk</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-medium">Nama Produk</label>
                <input type="text" name="name" id="editName" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Harga</label>
                <input type="number" name="price" id="editPrice" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" id="editDescription" class="w-full border rounded px-3 py-2" rows="3"></textarea>
            </div>
                        <div class="mb-4">
                <label class="block mb-1 font-medium">Gambar</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 hover:text-gray-900">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openEditModal(product) {
        const form = document.getElementById('editForm');
        form.action = `/admin/product/update/${product.id}`;
        document.getElementById('editName').value = product.name;
        document.getElementById('editPrice').value = product.price;
        document.getElementById('editDescription').value = product.description;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection