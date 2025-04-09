<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Sekolah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-white text-gray-800">

<!-- ✅ NAVBAR -->
<header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-xl font-bold text-blue-600">Nama Sekolah</a>
        <nav x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>
            <ul :class="{'block': open, 'hidden': !open}" class="absolute md:static right-0 mt-2 md:mt-0 w-48 md:w-auto bg-white md:bg-transparent md:flex space-y-2 md:space-y-0 md:space-x-6 text-sm md:text-base shadow md:shadow-none rounded md:rounded-none p-4 md:p-0">
                <li><a href="#hero" class="hover:text-blue-600">Beranda</a></li>
                <li><a href="#galeri" class="hover:text-blue-600">Galeri</a></li>
                <li><a href="#berita" class="hover:text-blue-600">Berita</a></li>
                <li><a href="#agenda" class="hover:text-blue-600">Agenda</a></li>
                <li><a href="#kontak" class="hover:text-blue-600">Kontak</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- ✅ HERO SECTION -->
<section class="relative w-full overflow-hidden">
    <div class="relative w-full">
        <div id="heroSlider" class="flex transition-transform duration-700 ease-in-out">
            @foreach($heroImages as $foto)
                <div class="min-w-full h-[60vh] lg:h-[75vh] relative">
                    <img src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-center px-6">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold">{{ $foto->judul }}</h1>
                    </div> 
                </div>
            @endforeach
        </div>

        <!-- Navigasi -->
        <button id="prevHeroSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-60 text-white px-3 py-2 rounded-full">❮</button>
        <button id="nextHeroSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-60 text-white px-3 py-2 rounded-full">❯</button>
    </div>
</section>

<!-- ✅ GALERI SECTION -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
        <div class="relative w-full overflow-hidden">
            <div id="gallerySlider" class="flex transition-transform duration-700 ease-in-out">
                @foreach($galleryImages as $foto)
                    <div class="min-w-full flex flex-col md:flex-row items-center gap-6">
                        <div class="md:w-1/2">
                            <img src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
                        </div>
                        <div class="md:w-1/2">
                            <h2 class="text-3xl font-bold">{{ $foto->judul }}</h2>
                            <p class="mt-4 text-gray-600">{{ $foto->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigasi Galeri -->
            <button id="prevGallerySlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❮</button>
            <button id="nextGallerySlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❯</button>
        </div>
    </div>
</section>

<!-- ✅ BERITA & AGENDA SECTION -->
<section class="py-16">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Kiri: Agenda Sekolah -->
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Agenda Sekolah</h2>
            <ul class="mt-4 space-y-4">
                @foreach($agendaSekolah as $agenda)
                    <li class="p-4 bg-gray-100 rounded-lg shadow text-gray-700 font-medium">
                        {{ is_object($agenda) ? $agenda->deskripsi : $agenda }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Kanan: Berita Sekolah -->
<div class="relative w-full overflow-hidden">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Informasi Terkini</h2>
    <div id="newsSlider" class="flex transition-transform duration-700 ease-in-out">
        @foreach($beritas as $berita)
            <div class="min-w-full">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    @php
                        $gambar = null;
                        if (!empty($berita->foto_upload)) {
                            $gambar = asset('storage/' . $berita->foto_upload);
                        } elseif (!empty($berita->foto) && !empty($berita->foto->file)) {
                            $gambar = asset('storage/' . $berita->foto->file);
                        } else {
                            $gambar = asset('images/default-news.jpg'); // fallback jika tidak ada gambar
                        }
                    @endphp

                    <img src="{{ $gambar }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $berita->judul }}</h3>
                        <p class="text-gray-500 text-sm">{{ Str::limit($berita->konten, 100) }}</p>
                        <a href="{{ route('berita.show', $berita->id) }}" class="text-blue-500 mt-2 inline-block">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button id="prevNewsSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❮</button>
    <button id="nextNewsSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❯</button>
</div>
    </div>
</section>


<!-- ✅ LOKASI SEKOLAH -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold">Lokasi Sekolah</h2>
        <div class="mt-6">
            <iframe class="w-full h-64 sm:h-96 rounded-lg shadow-lg"
                src="https://maps.google.com/maps?q=-6.2088,106.8456&z=15&output=embed">
            </iframe>
        </div>
    </div>
</section>

<!-- ✅ FOOTER -->
<footer class="bg-gray-800 text-white mt-16">
    <div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Info Sekolah -->
        <div>
            <h4 class="text-xl font-bold mb-2">Tentang Sekolah</h4>
            <p>Sekolah kami berkomitmen dalam menyediakan pendidikan berkualitas tinggi yang berbasis karakter dan teknologi.</p>
        </div>

        <!-- Tautan Navigasi -->
        <div>
            <h4 class="text-xl font-bold mb-2">Navigasi</h4>
            <ul class="space-y-2">
                <li><a href="#hero" class="hover:text-blue-400">Beranda</a></li>
                <li><a href="#galeri" class="hover:text-blue-400">Galeri</a></li>
                <li><a href="#berita" class="hover:text-blue-400">Berita</a></li>
                <li><a href="#agenda" class="hover:text-blue-400">Agenda</a></li>
                <li><a href="#kontak" class="hover:text-blue-400">Kontak</a></li>
            </ul>
        </div>

        <!-- Kontak -->
        <div>
            <h4 class="text-xl font-bold mb-2">Kontak</h4>
            <ul class="space-y-2 text-sm">
                <li><span class="font-semibold">Alamat:</span> Jl. Pendidikan No. 123, Jakarta</li>
                <li><span class="font-semibold">Email:</span> info@sekolahku.sch.id</li>
                <li><span class="font-semibold">Telepon:</span> (021) 1234-5678</li>
            </ul>
        </div>
    </div>
    <div class="text-center py-4 bg-gray-900 text-gray-400 text-sm">
        &copy; {{ date('Y') }} Nama Sekolah. All rights reserved.
    </div>
</footer>

<!-- ✅ SCRIPT SLIDER -->
<script>
    function initSlider(sliderId, prevBtnId, nextBtnId, autoSlide = true) {
        let slider = document.getElementById(sliderId);
        let index = 0;
        let totalSlides = slider.children.length;
        let interval;

        function updateSlide() {
            slider.style.transition = "transform 0.5s ease-in-out";
            slider.style.transform = `translateX(-${index * 100}%)`;
        }

        function nextSlide() {
            index = (index + 1) % totalSlides;
            updateSlide();
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            updateSlide();
        }

        document.getElementById(nextBtnId).addEventListener("click", () => {
            nextSlide();
            resetAutoSlide();
        });

        document.getElementById(prevBtnId).addEventListener("click", () => {
            prevSlide();
            resetAutoSlide();
        });

        function startAutoSlide() {
            if (autoSlide) {
                interval = setInterval(nextSlide, 5000);
            }
        }

        function resetAutoSlide() {
            if (autoSlide) {
                clearInterval(interval);
                startAutoSlide();
            }
        }

        startAutoSlide();
    }

    // Inisialisasi Slider
    initSlider("heroSlider", "prevHeroSlide", "nextHeroSlide");
    initSlider("gallerySlider", "prevGallerySlide", "nextGallerySlide");
    initSlider("newsSlider", "prevNewsSlide", "nextNewsSlide");
</script>

</body>
</html>
