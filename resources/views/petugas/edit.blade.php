@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-center mb-4">Edit Petugas</h2>

        <!-- Notifikasi error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $petugas->username) }}"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 @error('username') border-red-500 @enderror"
                    required>
            </div>

            <div>
                <label class="block text-gray-700">Password (Opsional)</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400"
                    placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white p-3 rounded-lg transition">
                Update
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('petugas.index') }}" class="text-yellow-500 hover:underline">Kembali ke daftar petugas</a>
        </div>
    </div>
</div>
@endsection
