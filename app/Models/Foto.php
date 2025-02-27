<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'file', 'galeri_id', 'created_by', 'updated_by'];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_foto');
    }

    public function createdBy()
    {
        return $this->belongsTo(Petugas::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Petugas::class, 'updated_by');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'created_by')->withDefault([
            'username' => 'Tidak diketahui'
        ]);
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }
}
