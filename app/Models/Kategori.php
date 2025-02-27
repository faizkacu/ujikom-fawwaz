<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    public function galeri()
    {
        return $this->belongsToMany(Galeri::class, 'kategori_galeri');
    }

    public function fotos()
    {
        return $this->belongsToMany(Foto::class, 'kategori_foto');
    }


    public function berita()
    {
        return $this->belongsToMany(Berita::class, 'kategori_berita');
    }
}
