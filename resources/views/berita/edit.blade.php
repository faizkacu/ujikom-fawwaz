<!-- resources/views/berita/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Berita</h2>

    <form action="{{ route('berita.update', $berita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Judul</label>
            <input type="text" name="judul" value="{{ $berita->judul }}" class="w-full p-2 border rounded-lg" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full p-2 border rounded-lg" required>{{ $berita->deskripsi }}</textarea>
        </div>

        <!-- Pilih Foto -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Pilih Foto</label>
            <select name="foto_id" class="w-full p-2 border rounded-lg">
                <option value="">Tanpa Foto</option>
                @foreach ($fotos as $foto)
                    <option value="{{ $foto->id }}" @if($berita->foto_id == $foto->id) selected @endif>
                        {{ $foto->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Kategori (Multiple) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Kategori</label>
            <select name="kategori_id[]" multiple class="w-full p-2 border rounded-lg">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @if($berita->kategoris->contains($kategori->id)) selected @endif>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <small class="text-gray-500">* Bisa memilih lebih dari satu</small>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                Update Berita
            </button>
        </div>
    </form>
</div>
@endsection
