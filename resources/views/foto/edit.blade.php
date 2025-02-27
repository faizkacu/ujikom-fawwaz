@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Foto</h2>

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Input Judul -->
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Foto</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $foto->judul) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300" 
                   required>
        </div>

        <!-- Input Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 resize-none" 
                      required>{{ old('deskripsi', $foto->deskripsi) }}</textarea>
        </div>

        <!-- Pilih Galeri -->
        <div>
            <label for="galeri_id" class="block text-sm font-medium text-gray-700">Pilih Galeri</label>
            <select name="galeri_id" id="galeri_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300" required>
                <option value="">-- Pilih Galeri --</option>
                @foreach ($galeris as $galeri)
                    <option value="{{ $galeri->id }}" {{ $galeri->id == $foto->galeri_id ? 'selected' : '' }}>
                        {{ $galeri->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Kategori -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Pilih Kategori</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($kategoris as $kategori)
                    <label class="flex items-center space-x-2">
                        <input 
                            type="checkbox" 
                            name="kategori_id[]" 
                            value="{{ $kategori->id }}" 
                            class="form-checkbox text-blue-600"
                            {{ in_array($kategori->id, $foto->kategoris->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $kategori->nama }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Foto Saat Ini -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
            <div class="mt-2">
                <img src="{{ asset('storage/' . $foto->file) }}" class="h-40 w-40 object-cover rounded-md shadow-md">
            </div>
        </div>

        <!-- Upload Foto Baru -->
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
            <input type="file" name="file" id="file" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300">
        </div>

        <!-- Tombol Submit & Batal -->
        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md transition duration-300">
                Update Foto
            </button>
            <a href="{{ route('foto.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300">Batal</a>
        </div>
    </form>
</div>
@endsection
