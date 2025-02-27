<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Tampilkan daftar foto.
     */
    public function index()
    {
        $fotos = Foto::with(['galeri', 'kategoris', 'createdBy', 'updatedBy'])->latest()->get();
        return view('foto.index', compact('fotos'));
    }

    /**
     * Tampilkan form tambah foto.
     */
    public function create()
    {
        $galeris = Galeri::all();
        $kategoris = Kategori::all();
        return view('foto.create', compact('galeris', 'kategoris'));
    }

    /**
     * Simpan foto yang baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'file' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'galeri_id' => 'required|exists:galeris,id',
            'kategori_id' => 'nullable|array',
            'kategori_id.*' => 'exists:kategoris,id',
        ]);

        $filePath = $request->file('file')->store('foto', 'public');

        $foto = Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'galeri_id' => $request->galeri_id,
            'created_by' => Auth::id(),
        ]);

        if ($request->has('kategori_id')) {
            $foto->kategoris()->sync($request->kategori_id);
        }

        return redirect()->route('foto.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit foto.
     */
    public function edit(Foto $foto)
    {
        $galeris = Galeri::all();
        $kategoris = Kategori::all();
        return view('foto.edit', compact('foto', 'galeris', 'kategoris'));
    }

    /**
     * Update foto.
     */
    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'file' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'galeri_id' => 'required|exists:galeris,id',
            'kategori_id' => 'nullable|array',
            'kategori_id.*' => 'exists:kategoris,id',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($foto->file);
            $filePath = $request->file('file')->store('foto', 'public');
        } else {
            $filePath = $foto->file;
        }

        $foto->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'galeri_id' => $request->galeri_id,
            'updated_by' => Auth::id(),
        ]);

        $foto->kategoris()->sync($request->kategori_id ?? []);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui!');
    }

    /**
     * Hapus foto.
     */
    public function destroy(Foto $foto)
    {
        Storage::disk('public')->delete($foto->file);
        $foto->kategoris()->detach(); 
        $foto->delete();
        

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus!');
    }
}
