@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold">{{ $berita->judul }}</h1>
    <img src="{{ asset('storage/' . $berita->foto?->file) }}" class="w-full my-4 rounded">
    <p class="text-gray-700">{{ $berita->deskripsi }}</p>
    <p class="mt-4 text-gray-500">Dibuat oleh: {{ $berita->createdBy->username }}</p>
    @if ($berita->updatedBy)
        <p class="text-gray-500">Diperbarui oleh: {{ $berita->updatedBy->username }}</p>
    @endif
    <div class="mt-4">
        <a href="{{ route('berita.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>
</div>
@endsection
