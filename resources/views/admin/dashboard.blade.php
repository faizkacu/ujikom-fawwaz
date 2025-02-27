@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Dashboard Admin</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Manajemen Galeri -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:scale-105 transition-transform">
            <h3 class="text-xl font-semibold text-gray-700">Manajemen Galeri</h3>
            <p class="text-gray-500 text-sm mt-2">Kelola semua galeri sekolah di sini.</p>
            <a href="{{ route('galeri.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-md transition">
                Kelola Galeri
            </a>
        </div>

        <!-- Manajemen Foto -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:scale-105 transition-transform">
            <h3 class="text-xl font-semibold text-gray-700">Manajemen Foto</h3>
            <p class="text-gray-500 text-sm mt-2">Tambahkan dan hapus foto dalam galeri.</p>
            <a href="{{ route('foto.index') }}" class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-md transition">
                Kelola Foto
            </a>
        </div>

        <!-- Manajemen Kategori -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:scale-105 transition-transform">
            <h3 class="text-xl font-semibold text-gray-700">Manajemen Kategori</h3>
            <p class="text-gray-500 text-sm mt-2">Atur kategori galeri untuk pengelompokan.</p>
            <a href="{{ route('kategori.index') }}" class="inline-block mt-4 bg-purple-500 hover:bg-purple-600 text-white px-5 py-2 rounded-md transition">
                Kelola Kategori
            </a>
        </div>

        <!-- Manajemen Berita -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:scale-105 transition-transform">
            <h3 class="text-xl font-semibold text-gray-700">Manajemen Berita</h3>
            <p class="text-gray-500 text-sm mt-2">Kelola berita terbaru untuk website.</p>
            <a href="{{ route('berita.index') }}" class="inline-block mt-4 bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md transition">
                Kelola Berita
            </a>
        </div>
    </div>

    <!-- Statistik Singkat -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-100 p-6 rounded-lg text-center">
            <h4 class="text-lg font-semibold text-blue-800">Total Galeri</h4>
            <p class="text-3xl font-bold">{{ \App\Models\Galeri::count() }}</p>
        </div>
        <div class="bg-green-100 p-6 rounded-lg text-center">
            <h4 class="text-lg font-semibold text-green-800">Total Foto</h4>
            <p class="text-3xl font-bold">{{ \App\Models\Foto::count() }}</p>
        </div>
        <div class="bg-red-100 p-6 rounded-lg text-center">
            <h4 class="text-lg font-semibold text-red-800">Total Berita</h4>
            <p class="text-3xl font-bold">{{ \App\Models\Berita::count() }}</p>
        </div>
    </div>
</div>
@endsection
