@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Kategori</h2>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
            <input 
                type="text" 
                name="nama" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-300" 
                value="{{ old('nama', $kategori->nama) }}" 
                required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md transition duration-300">
                Update
            </button>
            <a href="{{ route('kategori.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300">Batal</a>
        </div>
    </form>
</div>
@endsection
