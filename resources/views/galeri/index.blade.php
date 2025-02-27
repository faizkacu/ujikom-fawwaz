@extends('layouts.app')

@section('title', 'Kelola Galeri')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Kelola Galeri</h2>

    <!-- Tombol Tambah Galeri -->
    <div class="flex justify-start mb-4">
        <a href="{{ route('galeri.create') }}" 
            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            + Tambah Galeri
        </a>
    </div>

    <!-- Tabel Galeri -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Galeri</th>
                    <th class="p-3 text-left">Deskripsi</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galeri as $item)
                <tr class="border-b hover:bg-gray-100 transition duration-200">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $item->nama }}</td>
                    <td class="p-3 text-gray-700">{{ $item->deskripsi }}</td>
                    <td class="p-3 flex justify-center space-x-2">
                        <a href="{{ route('galeri.edit', $item->id) }}" 
                            class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-yellow-600 transition duration-300">
                            ✏ Edit
                        </a>
                        <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                🗑 Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
