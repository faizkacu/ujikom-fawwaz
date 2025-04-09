@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-5 p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Berita</h1>

    <!-- Tombol Tambah Berita -->
    <a href="{{ route('berita.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
        + Tambah Berita
    </a>

    <!-- Grid Berita -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($beritas as $berita)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border">
       <!-- Gambar Berita -->
   @if ($berita->foto_upload)
       <img src="{{ asset('storage/' . $berita->foto_upload) }}" class="w-full h-48 object-cover" alt="Gambar Upload">
   @elseif ($berita->foto)
       <img src="{{ asset('storage/' . $berita->foto->file) }}" class="w-full h-48 object-cover" alt="Gambar Galeri">
   @else
       <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
           Tidak ada gambar
       </div>
   @endif
   
<!-- Konten Berita -->
<div class="p-4">
<h2 class="text-lg font-semibold text-gray-800">{{ $berita->judul }}</h2>
<p class="text-sm text-gray-600 mt-1">🖊 Ditulis oleh: <strong>{{ $berita->createdBy->username }}</strong></p>

<!-- Kategori -->
@if ($berita->kategoris->isNotEmpty())
    <div class="mt-2 text-sm text-gray-600">
        🏷️
        @foreach ($berita->kategoris as $kategori)
            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full mr-1">
                {{ $kategori->nama }}
            </span>
        @endforeach
    </div>
@endif

<!-- Link Baca Selengkapnya -->
<a href="{{ route('berita.show', $berita) }}" class="text-blue-500 hover:underline mt-2 block">
    📖 Baca Selengkapnya
</a>

<!-- Tombol Edit & Hapus -->
<div class="flex justify-between items-center mt-4">
    <a href="{{ route('berita.edit', $berita) }}" class="text-yellow-500 hover:underline">
        ✏ Edit
    </a>

    <form action="{{ route('berita.destroy', $berita) }}" method="POST" 
          onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:underline">
            🗑 Hapus
        </button>
    </form>
</div>
</div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $beritas->links() }}
    </div>
</div>
@endsection
