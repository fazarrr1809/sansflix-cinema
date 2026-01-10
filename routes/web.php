<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FoodBeverageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;

// --- RUTE PUBLIK (Bisa diakses tanpa login) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show'); // Rute ini yang dicari!
Route::get('/movies/{id}', [HomeController::class, 'show'])->name('movies.show');

// Rute Auth (Login/Register)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // Route untuk redirect ke Google
    Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');

    // Route callback setelah login Google berhasil
    Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

// --- RUTE PRIVATE (Wajib login) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rute Booking Tiket
    Route::get('/booking/{showtimeId}', [BookingController::class, 'selectSeats'])->name('booking.seats');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/my-tickets', [BookingController::class, 'history'])->name('booking.history');
    Route::post('/booking/{id}/pay-now', [BookingController::class, 'payNow'])->name('booking.payNow');
    
    // Rute F&B / Makanan
    Route::get('/concessions', [FoodBeverageController::class, 'index'])->name('fnb.index');
    Route::get('/food-history', [CartController::class, 'history'])->name('food.history');
    Route::get('/cart/payment/{id}', [CartController::class, 'payment'])->name('cart.payment');
    Route::post('/cart/payment/{id}/proses', [CartController::class, 'payProses'])->name('cart.pay_proses');
    
    // Rute Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Route PDF
    Route::get('/booking/pdf/{id}', [BookingController::class, 'downloadPdf'])->name('booking.pdf');

    // Halaman tampilan E-Ticket (untuk tombol Lihat Tiket)
    Route::get('/booking/ticket/{id}', [BookingController::class, 'showTicket'])->name('booking.ticket');
    Route::get('/food-order/receipt/{id}', [CartController::class, 'showReceipt'])->name('food.receipt');
    Route::get('/food/download-receipt/{id}', [CartController::class, 'downloadReceipt'])->name('food.download');
    
    //update avatar user
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});