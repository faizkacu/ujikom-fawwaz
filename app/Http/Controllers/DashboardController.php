<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all(); // Mengambil semua data galeri
        return view('admin.dashboard', compact('galeri'));
    }
}
