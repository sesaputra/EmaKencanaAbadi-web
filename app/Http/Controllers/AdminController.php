<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showdashboard()
    {
        $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Siapkan data lengkap dari Jan - Des
        $userCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $userCounts[] = $monthlyUsers[$i] ?? 0;
        }

        $jumlahUser = User::count();
        $jumlahProduk = Product::count();
        return view('Admin.dashboard', compact('jumlahUser', 'jumlahProduk') + ['userCounts' => json_encode($userCounts)]);
    }
    public function showuser()
    {
        $users = User::select('id', 'name', 'email', 'photo', 'created_at')->latest()->get();

        return view('Admin.manajemenuser', compact('users'));
    }
    public function showproduct()
    {
        $products = Product::latest()->get(); // Ambil semua produk
        return view('Admin.manajemenproduct', compact('products'));
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib diisi saat menambah
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'image.required' => 'Gambar produk wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only('name', 'price', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.manajemenproduct')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tidak wajib diisi saat update
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only('name', 'price', 'description');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.manajemenproduct')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.manajemenproduct')->with('success', 'Produk berhasil dihapus.');
    }
    // public function showgalery()
    // {
    //     return view('Admin.manajemengalery');
    // }

    public function showgalery()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('Admin.manajemengalery', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('kegiatan', 'public');

        Kegiatan::create([
            'judul' => $request->judul,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($kegiatan->gambar);
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $kegiatan->gambar = $path;
        }

        $kegiatan->judul = $request->judul;
        $kegiatan->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        Storage::disk('public')->delete($kegiatan->gambar);
        $kegiatan->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }
}
