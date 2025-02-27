<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'petugas_id'];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_galeri');
    }
}
