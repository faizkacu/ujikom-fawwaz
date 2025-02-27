<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }

    public function foto_dibuat()
    {
        return $this->hasMany(Foto::class, 'created_by');
    }

    public function foto_diedit()
    {
        return $this->hasMany(Foto::class, 'updated_by');
    }

    public function berita_dibuat()
    {
        return $this->hasMany(Berita::class, 'created_by');
    }

    public function berita_diedit()
    {
        return $this->hasMany(Berita::class, 'updated_by');
    }
}
