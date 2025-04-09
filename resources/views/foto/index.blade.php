@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-5 p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Foto</h2>

    <!-- Tombol Tambah Foto -->
    <a href="{{ route('foto.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        + Tambah Foto
    </a>

    <!-- Grid Foto -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($fotos as $foto)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border">
                <!-- Foto -->
                {{-- @dd( $foto->file) --}}
                <img src="{{ asset('storage/' . $foto->file) }}" class="w-full h-48 object-cover">

                <!-- Info Foto -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $foto->judul }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Galeri: {{ $foto->galeri->nama }}</p>

                    <!-- Kategori -->
                    <div class="mt-2">
                        @if ($foto->kategoris->isNotEmpty())
                            @foreach ($foto->kategoris as $kategori)
                                <span class="bg-gray-300 text-gray-700 text-xs px-2 py-1 rounded">
                                    {{ $kategori->nama }}
                                </span>
                            @endforeach
                        @else
                            <span class="bg-red-400 text-white text-xs px-2 py-1 rounded">
                                Tidak ada kategori
                            </span>
                        @endif
                    </div>

                    <!-- Petugas Info -->
                    <div class="mt-3 text-sm text-gray-600">
                        <p>📌 Ditambahkan oleh: 
                            <strong>
                                {{ $foto->createdBy ? $foto->createdBy->username : 'Tidak diketahui' }}
                            </strong>
                        </p>
                    
                        <p>🖊 Diedit terakhir oleh: 
                            <strong>
                                {{ $foto->updatedBy ? $foto->updatedBy->username : 'Belum pernah diedit' }}
                            </strong>
                        </p>
                    </div>

                    <!-- Tombol Edit & Hapus -->
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('foto.edit', $foto->id) }}" class="text-blue-500 hover:underline">
                            ✏ Edit
                        </a>

                        <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
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
</div>
@endsection
