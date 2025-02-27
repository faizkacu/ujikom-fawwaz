@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 mb-10 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Tambah Foto</h2>

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Input Judul -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Judul Foto</label>
            <input 
                type="text" 
                name="judul" 
                value="{{ old('judul') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" 
                placeholder="Masukkan judul foto" 
                required>
        </div>

        <!-- Input Deskripsi -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300 resize-none"
                placeholder="Tambahkan deskripsi foto" 
                required>{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Upload Foto -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Pilih Foto</label>
            <input 
                type="file" 
                name="file" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-700"
                required>
        </div>

        <!-- Pilih Galeri -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Pilih Galeri</label>
            <select 
                name="galeri_id" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" 
                required>
                <option value="">-- Pilih Galeri --</option>
                @foreach ($galeris as $galeri)
                    <option value="{{ $galeri->id }}" {{ old('galeri_id') == $galeri->id ? 'selected' : '' }}>
                        {{ $galeri->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Kategori -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Pilih Kategori</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($kategoris as $kategori)
                    <label class="flex items-center space-x-2">
                        <input 
                            type="checkbox" 
                            name="kategori_id[]" 
                            value="{{ $kategori->id }}" 
                            class="form-checkbox text-blue-600"
                            {{ is_array(old('kategori_id')) && in_array($kategori->id, old('kategori_id')) ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $kategori->nama }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Tombol Submit & Batal -->
        <div class="flex items-center justify-between">
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md transition duration-300">
                Simpan
            </button>
            <a href="{{ route('foto.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300">Batal</a>
        </div>
    </form>
</div>
@endsection
