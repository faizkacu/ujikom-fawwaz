<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with(['foto', 'createdBy'])->latest()->paginate(10);
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        $fotos = Foto::all();
        $kategoris = Kategori::all();
        return view('berita.create', compact('fotos', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_id' => 'nullable|exists:fotos,id',
            'upload_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->filled('foto_id') && $request->hasFile('upload_foto')) {
            return back()->withErrors([
                'foto_id' => 'Pilih salah satu saja: dari galeri atau upload foto baru.',
                'upload_foto' => 'Pilih salah satu saja: dari galeri atau upload foto baru.',
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            $path = null;

            if ($request->hasFile('upload_foto')) {
                $path = $request->file('upload_foto')->store('berita', 'public');
            }

            $berita = Berita::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto_id' => $request->filled('foto_id') ? $request->foto_id : null,
                'foto_upload' => $path,
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

    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $fotos = Foto::all();
        $kategoris = Kategori::all();
        return view('berita.edit', compact('berita', 'fotos', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_id' => 'nullable|exists:fotos,id',
            'upload_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->filled('foto_id') && $request->hasFile('upload_foto')) {
            return back()->withErrors([
                'foto_id' => 'Pilih salah satu saja: dari galeri atau upload foto baru.',
                'upload_foto' => 'Pilih salah satu saja: dari galeri atau upload foto baru.',
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            // Jika upload baru
            if ($request->hasFile('upload_foto')) {
                if ($berita->foto_upload) {
                    Storage::disk('public')->delete($berita->foto_upload);
                }

                $berita->foto_upload = $request->file('upload_foto')->store('berita', 'public');
                $berita->foto_id = null; // clear foto_id karena upload baru
            } elseif ($request->filled('foto_id')) {
                if ($berita->foto_upload) {
                    Storage::disk('public')->delete($berita->foto_upload);
                }

                $berita->foto_upload = null;
                $berita->foto_id = $request->foto_id;
            }

            $berita->judul = $request->judul;
            $berita->deskripsi = $request->deskripsi;
            $berita->updated_by = Auth::id();
            $berita->save();

            $berita->kategoris()->sync($request->kategori_id ?? []);
            DB::commit();

            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Berita $berita)
    {
        DB::beginTransaction();
        try {
            if ($berita->foto_upload) {
                Storage::disk('public')->delete($berita->foto_upload);
            }

            $berita->delete();
            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}
