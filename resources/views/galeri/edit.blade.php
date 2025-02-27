@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Galeri</h2>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Galeri</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $galeri->nama) }}" 
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-400" 
                   placeholder="Masukkan nama galeri" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" 
                      class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-400" 
                      placeholder="Masukkan deskripsi galeri" required>{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md transition">
            Update Galeri
        </button>
    </form>
</div>
@endsection
