@extends('layouts.app')

@section('content')

<!-- ✅ HERO SECTION: SLIDER -->
<section class="relative w-full overflow-hidden">
    <div class="relative w-full">
        <div id="heroSlider" class="flex transition-transform duration-700 ease-in-out">
            @foreach($heroImages as $foto)
                <div class="min-w-full h-[50vh] sm:h-[60vh] lg:h-[75vh] relative">
                    <img src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}" 
                        class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-white text-center px-6">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">{{ $foto->judul }}</h1>
                        <p class="text-lg mt-3 max-w-2xl">{{ Str::limit($foto->deskripsi, 100) }}</p>
                    </div> 
                </div>
            @endforeach
        </div>

        <!-- Navigasi Slider -->
        <button id="prevHeroSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full hover:bg-opacity-80">❮</button>
        <button id="nextHeroSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full hover:bg-opacity-80">❯</button>
    </div>
</section>

<!-- ✅ GALERI SECTION -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
        <div class="relative w-full overflow-hidden">
            <!-- Slider Container -->
            <div id="gallerySlider" class="flex transition-transform duration-700 ease-in-out">
                @foreach($galleryImages as $foto)
                    <div class="min-w-full flex flex-col md:flex-row items-center">
                        <!-- Gambar -->
                        <div class="md:w-1/2">
                            <img src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}" 
                                 class="w-full h-64 object-cover rounded-lg shadow-lg">
                        </div>
                        <!-- Konten -->
                        <div class="md:w-1/2 p-6">
                            <h2 class="text-3xl font-bold text-gray-800">{{ $foto->judul }}</h2>
                            <p class="mt-4 text-gray-600">{{ $foto->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi -->
            <button id="prevGallerySlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❮</button>
            <button id="nextGallerySlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full">❯</button>
        </div>
    </div>
</section>


<!-- ✅ BERITA & AGENDA SECTION -->
<section class="py-16">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Kiri: Agenda Sekolah (DATA DARI DATABASE) -->
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
                            @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                        @elseif($berita->foto) 
                            <img src="{{ asset('storage/' . $berita->foto->file) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('images/default-news.jpg') }}" alt="Gambar tidak tersedia" class="w-full h-48 object-cover">
                        @endif
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

<!-- ✅ MAP SECTION -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Lokasi Sekolah</h2>
        <div class="mt-6">
            <iframe class="w-full h-64 sm:h-96 rounded-lg shadow-lg" 
                src="https://maps.google.com/maps?q=-6.2088,106.8456&z=15&output=embed">
            </iframe>
        </div>
    </div>
</section>

<!-- ✅ SCRIPT: Slider -->
<script>
    function initSlider(sliderId, prevBtnId, nextBtnId, autoSlide = true) {
    let slider = document.getElementById(sliderId);
    let index = 0;
    let totalSlides = slider.children.length;
    let interval;

    function updateSlide() {
        slider.style.transition = "transform 0.5s ease-in-out"; // Efek transisi lebih smooth
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
        resetAutoSlide(); // Reset timer jika user menekan tombol
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

// Inisialisasi untuk semua slider
initSlider("heroSlider", "prevHeroSlide", "nextHeroSlide");
initSlider("gallerySlider", "prevGallerySlide", "nextGallerySlide");
initSlider("newsSlider", "prevNewsSlide", "nextNewsSlide");

</script>

@endsection
