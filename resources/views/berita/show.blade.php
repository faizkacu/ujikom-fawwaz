<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <!-- Tailwind CSS -->
     <script src="https://cdn.tailwindcss.com"></script>

     <!-- Alpine.js -->
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-6">
        <!-- Judul Berita -->
        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $berita->judul }}</h1>
    
        <!-- Informasi Penulis -->
        <div class="flex items-center gap-4 mt-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($berita->createdBy->username) }}&background=random&size=50"
                 alt="Avatar" class="w-12 h-12 rounded-full shadow">
            <div>
                <p class="text-lg font-semibold text-gray-800">{{ $berita->createdBy->username }}</p>
                <p class="text-sm text-gray-500">{{ $berita->created_at->format('d F Y') }} • {{ $berita->created_at->diffForHumans() }}</p>
            </div>
        </div>
    
        <!-- Gambar Berita -->
        <div class="mt-6">
            <img src="{{ asset('storage/' . $berita->foto?->file) }}" 
                 class="w-full max-h-[500px] object-cover rounded-lg shadow-lg aspect-video"
                 alt="Gambar Berita">
        </div>
    
        <!-- Isi Berita -->
        <article class="mt-8 text-gray-900 text-lg leading-loose">
            {!! nl2br(e($berita->deskripsi)) !!}
        </article>
    
        <!-- Informasi Pembaruan -->
        @if ($berita->updatedBy)
            <p class="mt-6 text-sm text-gray-500">
                ✏️ Diperbarui oleh <strong>{{ $berita->updatedBy->username }}</strong> pada {{ $berita->updated_at->format('d F Y, H:i') }}
            </p>
        @endif
    
        <!-- Tombol Kembali -->
        <div class="mt-8">
            <a href="{{ route('home') }}" 
               class="inline-block bg-blue-600 text-white text-lg px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition">
                ⬅ Kembali ke halaman
            </a>
        </div>
    </div>
        
</body>
</html>
