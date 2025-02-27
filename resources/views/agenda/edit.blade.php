@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Agenda</h2>

    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border-gray-300 rounded p-2" required>{{ $agenda->deskripsi }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
