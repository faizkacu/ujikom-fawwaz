@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Agenda</h2>

    <form action="{{ route('agenda.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="tanggal" class="block font-semibold">Tanggal (Bebas)</label>
            <input type="text" name="tanggal" id="tanggal" class="w-full border rounded p-2" placeholder="Contoh: 09 April 2025" required value="{{ old('tanggal') }}">
        </div>

        <div>
            <label for="deskripsi" class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border rounded p-2" required>{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
