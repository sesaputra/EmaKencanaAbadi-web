<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Tampilkan form login
    public function showdashboard()
    {
        if (Auth::check()) {
            $user = Auth::user(); // aman digunakan
        } else {
            $user = null;
        }

        return view('User.dashboard');
    }
    public function showcontact()
    {
        if (Auth::check()) {
            $user = Auth::user(); // aman digunakan
        } else {
            $user = null;
        }

        return view('User.contact');
    }
    public function showabout()
    {
      $kegiatan = Kegiatan::all();
        return view('User.about', compact('kegiatan'));
    }
    public function showproduct()
    {
        $products = Product::all(); // atau pakai ->latest()->take(6) untuk unggulan
        return view('User.produk', compact('products'));
    }
}
