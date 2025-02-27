@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Login</h2>

        @if(session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" class="w-full border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg p-3 shadow-sm" placeholder="Enter your username">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg p-3 shadow-sm" placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium p-3 rounded-lg transition duration-300 shadow-md">
                Login
            </button>
        </form>

        {{-- <div class="text-center mt-4">
            <p class="text-sm"> Udah daftar belum ?
                <a href="{{ route('register') }}" class="text-green-500 hover:underline">daftar disini</a>
            </p>
        </div> --}}
    </div>
</div>
@endsection
