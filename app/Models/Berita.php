<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';
    protected $fillable = ['judul', 'deskripsi', 'foto_id', 'created_by', 'updated_by'];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'berita_kategori');
    }

    public function createdBy()
    {
        return $this->belongsTo(Petugas::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Petugas::class, 'updated_by');
    }

    
}
