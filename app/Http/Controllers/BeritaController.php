<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
  
    // 📌 Menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::with(['foto', 'createdBy'])->latest()->paginate(10);
        return view('berita.index', compact('beritas'));
    }

    // 📌 Form tambah berita
    public function create()
    {
        $fotos = Foto::all();
        $kategoris = Kategori::all();
        return view('berita.create', compact('fotos', 'kategoris'));
    }

    // 📌 Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_id' => 'nullable|exists:fotos,id',
        ]);

        DB::beginTransaction();
        try {
            $berita = Berita::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto_id' => $request->foto_id,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);

            $berita->kategoris()->sync($request->kategori_id ?? []);

            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 📌 Menampilkan detail berita
    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    // 📌 Form edit berita
    public function edit(Berita $berita)
    {
        $fotos = Foto::all();
        $kategoris = Kategori::all();
        return view('berita.edit', compact('berita', 'fotos', 'kategoris'));
    }

    // 📌 Menyimpan perubahan berita
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_id' => 'nullable|exists:fotos,id',
        ]);

        DB::beginTransaction();
        try {
            $berita->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto_id' => $request->foto_id,
                'updated_by' => Auth::id(),
            ]);

            $berita->kategoris()->sync($request->kategori_id ?? []);

            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 📌 Menghapus berita
    public function destroy(Berita $berita)
    {
        DB::beginTransaction();
        try {
            $berita->delete();
            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}
