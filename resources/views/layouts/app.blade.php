<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Membuat sidebar tetap di tempat */
        .sticky-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- ✅ Sidebar Sticky -->
    <aside class="hidden md:flex flex-col bg-white w-64 p-6 shadow-md border-r sticky-sidebar">
        <h2 class="text-2xl font-bold text-[#17A9F2] text-center mb-6">Galeri Sekolah</h2>

        <ul class="space-y-4 flex-1">
            <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">🏠 Beranda</a></li>
            <li><a href="{{ route('galeri.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">🖼️ Galeri</a></li>
            <li><a href="{{ route('foto.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">📷 Foto</a></li>
            <li><a href="{{ route('kategori.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">🏷️ Kategori</a></li>
            <li><a href="{{ route('berita.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">📰 Berita</a></li>
            <li><a href="{{ route('agenda.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">📰 Agenda</a></li>
        </ul>

        <!-- ✅ Tombol Logout -->
        @auth
            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg text-center hover:bg-red-600 transition">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block bg-[#17A9F2] text-white text-center py-2 rounded-lg">Login</a>
        @endauth
    </aside>

    <!-- ✅ Navbar Mobile Sticky -->
    <nav class="md:hidden bg-white shadow-md w-full fixed top-0 left-0 z-50">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h2 class="text-lg font-bold text-[#17A9F2]">Galeri Sekolah</h2>

            <!-- Tombol Menu Mobile -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="text-gray-700">☰</button>

                <!-- Menu Mobile -->
                <div x-show="open" class="fixed inset-0 bg-gray-900 bg-opacity-80 flex flex-col items-center justify-center z-50 p-6 text-white text-xl" x-transition>
                    <button @click="open = false" class="absolute top-4 right-4 text-2xl">✖</button>

                    <ul class="space-y-6">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-[#17A9F2]">🏠 Beranda</a></li>
                        <li><a href="{{ route('galeri.index') }}" class="hover:text-[#17A9F2]">🖼️ Galeri</a></li>
                        <li><a href="{{ route('foto.index') }}" class="hover:text-[#17A9F2]">📷 Foto</a></li>
                        <li><a href="{{ route('kategori.index') }}" class="hover:text-[#17A9F2]">🏷️ Kategori</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-[#17A9F2]">📰 Berita</a></li>
                        <li><a href="{{ route('agenda.index') }}" class="hover:text-[#17A9F2]">📰 agenda</a></li>

                        @auth
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="bg-[#17A9F2] px-4 py-2 rounded-lg">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ✅ Konten Utama (tidak sticky, bisa di-scroll penuh) -->
    <div class="flex-1 p-6 mt-16 md:mt-0 md:ml-64">
        @yield('content')
    </div>

</body>
</html>
