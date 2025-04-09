@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Agenda</h2>

    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="tanggal" class="block font-semibold">Tanggal (Bebas)</label>
            <input type="text" name="tanggal" id="tanggal" class="w-full border rounded p-2" required value="{{ old('tanggal', $agenda->tanggal) }}">
        </div>

        <div>
            <label for="deskripsi" class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border rounded p-2" required>{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Perbarui</button>
    </form>
</div>
@endsection
