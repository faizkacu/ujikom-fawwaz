<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    // Menampilkan daftar agenda
    public function index()
    {
        $agendas = Agenda::latest()->get();
        return view('agenda.index', compact('agendas'));
    }

    // Menampilkan form tambah agenda
    public function create()
    {
        return view('agenda.create');
    }

    // Menyimpan agenda baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        Agenda::create([
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    // Menampilkan form edit agenda
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    // Memperbarui agenda
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        $agenda->update([
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    // Menghapus agenda
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
