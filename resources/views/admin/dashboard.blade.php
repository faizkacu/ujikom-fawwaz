@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Dashboard Admin</h2>

    @php
        $menus = [
            [
                'title' => 'Manajemen Galeri',
                'desc' => 'Kelola semua galeri sekolah di sini.',
                'route' => route('galeri.index'),
                'color' => 'blue'
            ],
            [
                'title' => 'Manajemen Foto',
                'desc' => 'Tambahkan dan hapus foto dalam galeri.',
                'route' => route('foto.index'),
                'color' => 'green'
            ],
            [
                'title' => 'Manajemen Kategori',
                'desc' => 'Atur kategori galeri untuk pengelompokan.',
                'route' => route('kategori.index'),
                'color' => 'purple'
            ],
            [
                'title' => 'Manajemen Berita',
                'desc' => 'Kelola berita terbaru untuk website.',
                'route' => route('berita.index'),
                'color' => 'red'
            ],
            [
                'title' => 'Manajemen Agenda',
                'desc' => 'Kelola agenda dan kegiatan sekolah.',
                'route' => route('agenda.index'),
                'color' => 'yellow'
            ],
            [
                'title' => 'Manajemen Petugas',
                'desc' => 'Kelola akun petugas atau admin sistem.',
                'route' => route('petugas.index'),
                'color' => 'indigo'
            ],
        ];
    @endphp

    <!-- Menu Manajemen -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menus as $menu)
            <div class="bg-white border-l-4 border-{{ $menu['color'] }}-500 rounded-lg shadow p-5 hover:shadow-lg transition-all">
                <h3 class="text-xl font-semibold text-gray-700">{{ $menu['title'] }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $menu['desc'] }}</p>
                <a href="{{ $menu['route'] }}" class="inline-block mt-4 text-sm text-white bg-{{ $menu['color'] }}-500 hover:bg-{{ $menu['color'] }}-600 px-4 py-2 rounded transition">
                    Kelola
                </a>
            </div>
        @endforeach
    </div>

    <!-- Statistik -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        @php
            $stats = [
                ['label' => 'Total Galeri', 'count' => \App\Models\Galeri::count(), 'color' => 'blue'],
                ['label' => 'Total Foto', 'count' => \App\Models\Foto::count(), 'color' => 'green'],
                ['label' => 'Total Berita', 'count' => \App\Models\Berita::count(), 'color' => 'red'],
                ['label' => 'Total Agenda', 'count' => \App\Models\Agenda::count(), 'color' => 'yellow'],
                ['label' => 'Total Petugas', 'count' => \App\Models\Petugas::count(), 'color' => 'indigo'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="bg-{{ $stat['color'] }}-100 text-center p-6 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-{{ $stat['color'] }}-800">{{ $stat['label'] }}</h4>
                <p class="text-3xl font-bold text-{{ $stat['color'] }}-900 mt-2">{{ $stat['count'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
