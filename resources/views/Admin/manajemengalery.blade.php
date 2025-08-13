@extends('Admin.layouts.app')

@section('content')
<div class="flex flex-col w-full mx-auto mt-6 mb-12 px-4 lg:px-12">
    {{-- Tombol Tambah Gambar --}}
    <div class="flex justify-end mb-4">
        <button onclick="openAddModal()"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Gambar
        </button>
    </div>

    <h2 class="text-xl font-bold text-gray-800 mb-3">Galeri Kegiatan</h2>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow mb-10">
        <table class="min-w-full text-base text-gray-700 divide-y divide-gray-200">
            <thead class="bg-gray-50 text-gray-600 uppercase tracking-wider text-sm">
                <tr>
                    <th class="px-6 py-4 font-semibold">#</th>
                    <th class="px-6 py-4 font-semibold">Judul</th>
                    <th class="px-6 py-4 font-semibold">Gambar</th>
                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($kegiatan as $item)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $item->judul }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-20 h-20 object-cover rounded border">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center gap-2 flex-wrap">
                            <button onclick="openEditModal({{ $item->id }}, '{{ $item->judul }}')"
                                class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded hover:bg-yellow-300 transition">
                                Edit
                            </button>
                            <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus gambar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-semibold text-white bg-red-600 rounded hover:bg-red-700 transition">
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
</div>

{{-- Modal Tambah --}}
<div id="addModal" class="fixed inset-0 backdrop-blur-md bg-white/10 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h3 class="text-xl font-semibold mb-4">Tambah Gambar Kegiatan</h3>
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul</label>
                <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Gambar</label>
                <input type="file" name="gambar" class="w-full border rounded px-3 py-2" required>
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
        <h3 class="text-xl font-semibold mb-4">Edit Gambar Kegiatan</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul</label>
                <input type="text" name="judul" id="editJudul" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Gambar Baru (Opsional)</label>
                <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
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

    function openEditModal(id, judul) {
        const form = document.getElementById('editForm');
        form.action = `/admin/kegiatan/${id}`;
        document.getElementById('editJudul').value = judul;

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
