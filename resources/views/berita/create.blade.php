@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        {{ isset($berita) ? '✏️ Edit Berita' : '📰 Tambah Berita' }}
    </h2>

    @if(session('error'))
        <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
    @endif

    <form action="{{ isset($berita) ? route('berita.update', $berita->id) : route('berita.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="space-y-5">
        @csrf
        @if(isset($berita))
            @method('PUT')
        @endif

        <!-- Judul -->
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="judul" id="judul" required
                value="{{ old('judul', $berita->judul ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            @error('judul') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Deskripsi (Trix Editor) -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $berita->deskripsi ?? '') }}">
            <trix-editor input="deskripsi" class="trix-content bg-white border border-gray-300 rounded-lg"></trix-editor>
            @error('deskripsi') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Upload Gambar -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
            <input type="file" name="upload_foto" accept="image/*" class="block w-full text-sm text-gray-700">
            @error('upload_foto') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Pilih dari Galeri -->
        <div>
            <label for="foto_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Foto dari Galeri</label>
            <select name="foto_id" id="foto_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Tidak pilih --</option>
                @foreach ($fotos as $foto)
                    <option value="{{ $foto->id }}"
                        {{ old('foto_id', $berita->foto_id ?? '') == $foto->id ? 'selected' : '' }}>
                        {{ $foto->judul }}
                    </option>
                @endforeach
            </select>
            @error('foto_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Peringatan Pilihan Gambar -->
        <div class="text-sm text-yellow-600">
            ⚠️ Hanya boleh memilih satu: <strong>upload gambar</strong> atau <strong>pilih dari galeri</strong>.
        </div>

        <!-- Pilih Kategori -->
        <div>
            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id[]" id="kategori_id" multiple
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ collect(old('kategori_id', isset($berita) ? $berita->kategoris->pluck('id')->toArray() : []))->contains($kategori->id) ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <small class="text-gray-500">* Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu</small>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end">
            <button type="submit"
                class="{{ isset($berita) ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white px-6 py-2 rounded-lg transition">
                {{ isset($berita) ? 'Simpan Perubahan' : 'Simpan Berita' }}
            </button>
        </div>
    </form>
</div>
@endsection
