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
    <style>
         html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="#" class="text-2xl font-bold text-blue-600 tracking-wide">SMK TI DWIGUNA</a>
            
            <!-- Hamburger menu (mobile) -->
            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
    
                <!-- Mobile menu -->
                <ul x-show="open" @click.away="open = false" class="absolute top-16 left-0 w-full bg-white shadow-md px-6 py-4 space-y-2 md:hidden">
                    <li><a href="#hero" class="block text-gray-700 hover:text-blue-500">Beranda</a></li>
                    <li><a href="#galeri" class="block text-gray-700 hover:text-blue-500">Galeri</a></li>
                    <li><a href="#berita" class="block text-gray-700 hover:text-blue-500">Berita</a></li>
                    <li><a href="#agenda" class="block text-gray-700 hover:text-blue-500">Agenda</a></li>
                    <li><a href="#kontak" class="block text-gray-700 hover:text-blue-500">Kontak</a></li>
                </ul>
            </div>
    
            <!-- Desktop menu -->
            <nav class="hidden md:flex space-x-8 text-base font-medium">
                <a href="#hero" class="text-gray-700 hover:text-blue-600 transition duration-200">Beranda</a>
                <a href="#galeri" class="text-gray-700 hover:text-blue-600 transition duration-200">Galeri</a>
                <a href="#berita" class="text-gray-700 hover:text-blue-600 transition duration-200">Berita</a>
                <a href="#agenda" class="text-gray-700 hover:text-blue-600 transition duration-200">Agenda</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition duration-200">Kontak</a>
            </nav>
        </div>
    </header>


<!-- ✅ HERO SECTION -->
<section class="relative w-full overflow-hidden" id="hero">
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
<section class="py-16 bg-gray-100" id="galeri">
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
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10" id="agenda">
       <!-- Kiri: Agenda Sekolah -->
<div>
    <h2 class="text-3xl font-bold text-gray-800">Agenda Sekolah</h2>
    <ul class="mt-4 space-y-4">
        @forelse($agendaSekolah as $agenda)
            <li class="p-4 bg-gray-100 rounded-lg shadow text-gray-700">
                <div class="font-bold text-blue-600 mb-1">
                    📅 {{ $agenda->tanggal ?? '-' }}
                </div>
                <div class="font-bold text-2xl">
                    {{ $agenda->deskripsi }}
                </div>
            </li>
        @empty
            <li class="p-4 bg-red-100 text-red-700 rounded shadow text-center">Belum ada agenda sekolah.</li>
        @endforelse
    </ul>
</div>

        <!-- Kanan: Berita Sekolah -->
<div class="relative w-full overflow-hidden" id="berita">
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.661689935032!2d106.80468250985209!3d-6.43747806292208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e901c47640f7%3A0x2251ab94bef61b08!2sSMK%20TI%20Dwiguna!5e0!3m2!1sid!2sid!4v1744206903297!5m2!1sid!2sid">
            </iframe>
        </div>
    </div>
</section>

<!-- ✅ FOOTER -->
<footer class="bg-gray-800 text-white mt-16" id="kontak">
    <div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Info Sekolah -->
        <div>
            <h4 class="text-xl font-bold mb-2">Tentang Sekolah</h4>
            <p>SMK TI Dwiguna Depok adalah lembaga pendidikan vokasi yang berkomitmen mencetak generasi muda yang unggul di bidang Teknologi Informasi dan Komunikasi (TIK) serta Otomotif. Dengan mengadopsi kurikulum terkini, kami menyediakan lingkungan belajar yang kondusif untuk mengasah keterampilan teknis dan soft skills siswa. SMK TI Dwiguna menawarkan program studi yang relevan dengan kebutuhan industri, sehingga lulusan kami siap bersaing di dunia kerja yang semakin kompetitif.</p>
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
                <li><span class="font-semibold">Alamat:</span> Gg. Elga Jl. H. Dul No.100, Bojong Pd. Terong, Kec. Cipayung, Kota Depok, Jawa Barat 16444</li>
                <li><span class="font-semibold">Email:</span> smk.dwiguna@gmail.com</li>
                <li><span class="font-semibold">Telepon:</span> 0812-7066-7483</li>
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

    document.addEventListener("DOMContentLoaded", () => {
        initSlider("heroSlider", "prevHeroSlide", "nextHeroSlide", true);     // Slider utama (hero)
        initSlider("gallerySlider", "prevGallerySlide", "nextGallerySlide", false); // Galeri manual
        initSlider("newsSlider", "prevNewsSlide", "nextNewsSlide", false);    // Berita manual
    });
</script>

</body>
</html>
