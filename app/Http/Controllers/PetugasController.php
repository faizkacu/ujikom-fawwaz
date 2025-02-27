<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // Menampilkan daftar petugas
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas'));
    }

    // Menampilkan form tambah petugas
    public function create()
    {
        return view('petugas.create');
    }

    // Menyimpan data petugas ke database
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas',
            'password' => 'required|min:6',
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    // Menampilkan form edit petugas
    public function edit(Petugas $petugas)
    {
        return view('petugas.edit', compact('petugas'));
    }

    // Memperbarui data petugas
    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'username' => 'required|unique:petugas,username,' . $petugas->id,
            'password' => 'nullable|min:6', // Password opsional, hanya diperbarui jika diisi
        ]);

        $data = ['username' => $request->username];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    // Menghapus petugas
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        // Hapus petugas dari database
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
