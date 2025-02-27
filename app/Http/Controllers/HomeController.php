<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Kategori;
use App\Models\Berita;
use App\Models\Agenda;

class HomeController extends Controller
{
    public function index()
    {
        $heroImages = Foto::latest()->take(5)->get(); // Slider hero section
        $agendaSekolah = Agenda::latest()->take(5)->get();
        $galleryImages = Foto::latest()->take(6)->get(); // Slider galeri
        $kategoris = Kategori::all();
        $beritas = Berita::latest()->take(5)->get(); // Slider berita

        // // Agenda Sekolah (teks statis)
        // $agendaSekolah = [
        //     "Pendaftaran siswa baru dibuka mulai Maret.",
        //     "Ujian Tengah Semester (UTS) akan dimulai pada bulan April.",
        //     "Lomba sains antar sekolah akan diselenggarakan bulan Mei.",
        //     "Kegiatan Pramuka setiap hari Sabtu pukul 08:00 WIB."
        // ];

        return view('home', compact('heroImages', 'galleryImages', 'kategoris', 'beritas', 'agendaSekolah'));
    }
}
