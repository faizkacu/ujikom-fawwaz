@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Berita</h2>

    @if(session('error'))
        <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
    @endif

    <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            @error('judul') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="5" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
            @error('deskripsi') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Pilih dari Galeri -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Foto dari Galeri</label>
            <select name="foto_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Tidak pilih --</option>
                @foreach ($fotos as $foto)
                    <option value="{{ $foto->id }}" {{ old('foto_id', $berita->foto_id) == $foto->id ? 'selected' : '' }}>
                        {{ $foto->judul }}
                    </option>
                @endforeach
            </select>
            @error('foto_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ $berita->kategoris->contains($kategori->id) ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <small class="text-gray-500">* Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu</small>
        </div>

        <!-- Tombol Update -->
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
