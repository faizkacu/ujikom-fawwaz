<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galeri Sekolah')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Alpine.js untuk Toggle Navbar -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">

    <!-- ✅ Navbar -->
    <nav class="bg-[#17A9F2] text-white sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">
            <a href="{{ route('home') }}" class="text-lg font-bold">Galeri Sekolah</a>

            <!-- ✅ Toggle Button untuk Mobile -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="md:hidden focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- ✅ Menu Utama (Desktop) -->
                <ul class="hidden md:flex space-x-6">

                    @auth
                    <li><a href="{{ route('dashboard') }}" class="hover:underline">Beranda</a></li>
                        <li><a href="{{ route('galeri.index') }}" class="hover:underline">Galeri</a></li>
                        <li><a href="{{ route('foto.index') }}" class="hover:underline">Foto</a></li>
                        <li><a href="{{ route('kategori.index') }}" class="hover:underline">Kategori</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:underline">Berita</a></li>
                        <li><a href="{{ route('petugas.index') }}" class="hover:underline">Petugas</a></li>
                        <li><a href="{{ route('agenda.index') }}" class="hover:underline">agenda</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="bg-blue-700 px-3 py-1 rounded hover:bg-blue-800">Login</a></li>
                        <li><a href="{{ route('register') }}" class="bg-green-500 px-3 py-1 rounded hover:bg-green-600">Register</a></li>
                    @endauth
                </ul>

                <!-- ✅ Menu Mobile (Overlay Penuh Layar) -->
                <div x-show="open" class="fixed inset-0 bg-[#17A9F2] bg-opacity-95 flex flex-col items-center justify-center z-50" x-transition>
                    <button @click="open = false" class="absolute top-4 right-4 text-white text-2xl">✖</button>
                    
                    <ul class="space-y-6 text-xl text-center">

                        @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:underline block">Dashboard</a></li>
                            <li><a href="{{ route('galeri.index') }}" class="hover:underline block">Galeri</a></li>
                            <li><a href="{{ route('foto.index') }}" class="hover:underline block">Foto</a></li>
                            <li><a href="{{ route('kategori.index') }}" class="hover:underline block">Kategori</a></li>
                            <li><a href="{{ route('berita.index') }}" class="hover:underline block">Berita</a></li>
                            <li><a href="{{ route('petugas.index') }}" class="hover:underline">Petugas</a></li>
                            <li><a href="{{ route('agenda.index') }}" class="hover:underline">agenda</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-center bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="block bg-blue-700 px-4 py-2 rounded hover:bg-blue-800">Login</a></li>
                            <li><a href="{{ route('register') }}" class="block bg-green-500 px-4 py-2 rounded hover:bg-green-600">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ✅ Konten Utama -->
    <div>
        @yield('content')
    </div>

</body>
</html>
