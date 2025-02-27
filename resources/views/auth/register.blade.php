@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Create an Account</h2>

        <!-- Menampilkan pesan error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4"> 
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" 
                    class="w-full focus:ring-2 focus:ring-green-400 focus:border-green-400 rounded-lg p-3 shadow-sm @error('username') border-red-500 @enderror" 
                    placeholder="Enter your username" required>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" 
                    class="w-full focus:ring-2 focus:ring-green-400 focus:border-green-400 rounded-lg p-3 shadow-sm @error('password') border-red-500 @enderror" 
                    placeholder="Create a password" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium p-3 rounded-lg transition duration-300 shadow-md">
                Register
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-gray-600 text-sm">Sudah punya akun?  
                <a href="{{ route('login') }}" class="text-green-500 hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
