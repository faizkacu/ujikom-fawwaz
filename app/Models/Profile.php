<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama_sekolah', 'alamat', 'kontak', 'email', 'deskripsi', 'logo'];
}
