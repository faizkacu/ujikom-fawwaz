<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;


// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/berita', BeritaController::class)->parameters([
    'berita' => 'berita'
]);

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Admin Dashboard (Protected)eb
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('petugas', PetugasController::class)->parameters([
        'petugas' => 'petugas'
    ]);    
    // Route::resource('/berita', BeritaController::class)->except(['show']); 
    Route::resource('/galeri', GaleriController::class);
    Route::resource('/foto', FotoController::class);
    Route::resource('/agenda', AgendaController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/profile', ProfileController::class);
});
