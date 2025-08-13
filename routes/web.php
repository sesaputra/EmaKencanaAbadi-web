<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');



// User Routes
Route::get('/dashboard', [UserController::class, 'showdashboard'])->name('dashboard');
Route::get('/contact', [UserController::class, 'showcontact'])->name('contact');
Route::get('/about', [UserController::class, 'showabout'])->name('about');
Route::get('/product', [UserController::class, 'showproduct'])->name('product');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showdashboard'])->name('admin.dashboard');
    Route::get('/manajemenuser', [AdminController::class, 'showuser'])->name('admin.manajemenuser');
    Route::get('/manajemenproduk', [AdminController::class, 'showproduct'])->name('admin.manajemenproduct');
    // Tambah Produk
    Route::post('/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');

    // Update Produk
    Route::put('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');

    // Hapus Produk
    Route::delete('/product/destroy/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.destroy');
    // Kegiatan Routes
    Route::get('/manajemengalery', [AdminController::class, 'showgalery'])->name('admin.manajemengalery');
    Route::post('/manajemengalery/store', [AdminController::class, 'store'])->name('admin.kegiatan.store');
    Route::put('/manajemengalery/update/{kegiatan}', [AdminController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/manajemengalery/delete/{kegiatan}', [AdminController::class, 'destroy'])->name('admin.kegiatan.destroy');
});





Route::get('/', function () {
    return view('User.dashboard');
});
