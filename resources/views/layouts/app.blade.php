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

    {{-- Hero Icons --}}
    <script src="https://unpkg.com/@heroicons/vue@2.0.16/outline/index.js" type="module"></script>

    <!-- Di bagian <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" defer></script>

    <style>
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

    <ul class="space-y-4 flex-1 text-gray-700">
        <li>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Home -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                </svg>                  
                Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('galeri.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Collection -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                </svg>  
                Galeri
            </a>
        </li>
        <li>
            <a href="{{ route('foto.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Camera -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                    <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>                  
                Foto
            </a>
        </li>
        <li>
            <a href="{{ route('kategori.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Tag -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                </svg>                  
                Kategori
            </a>
        </li>
        <li>
            <a href="{{ route('berita.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Newspaper -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
                    <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
                </svg>                  
                Berita
            </a>
        </li>
        <li>
            <a href="{{ route('agenda.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Calendar -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                </svg>                  
                Agenda
            </a>
        </li>
        <li>
            <a href="{{ route('petugas.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#17A9F2] hover:text-white transition">
                <!-- Heroicon: Users -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>                  
                Petugas
            </a>
        </li>
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
