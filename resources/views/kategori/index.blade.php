@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Daftar Kategori</h2>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('kategori.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition duration-300">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-500 text-white uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">Nama Kategori</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $kategori)
                    <tr class="border-b hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-4 text-gray-700">{{ $kategori->nama }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Edit</a>
                            |
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200" onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($kategoris->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center py-4 text-gray-500">Tidak ada kategori tersedia</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
