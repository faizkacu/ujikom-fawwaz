@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Agenda</h2>

    <a href="{{ route('agenda.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Agenda</a>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $agenda)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $agenda->tanggal }}</td>
                    <td class="px-4 py-2">{{ $agenda->deskripsi }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('agenda.edit', $agenda->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
