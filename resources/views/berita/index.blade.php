@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Daftar Berita</h1>
    <a href="{{ route('berita.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Berita</a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        @foreach ($beritas as $berita)
        <div class="bg-white p-4 rounded shadow">
            <img src="{{ asset('storage/' . $berita->foto?->file) }}" class="w-48">            <h2 class="text-xl font-bold mt-2">{{ $berita->judul }}</h2>
            <p class="text-gray-500 text-sm">Dibuat oleh: {{ $berita->createdBy->username }}</p>
            <a href="{{ route('berita.show', $berita) }}" class="text-blue-500 mt-2 block">Baca Selengkapnya</a>
            <div class="mt-2 flex gap-2">
                <a href="{{ route('berita.edit', $berita) }}" class="text-yellow-500">Edit</a>
                <form action="{{ route('berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $beritas->links() }}
    </div>
</div>
@endsection
