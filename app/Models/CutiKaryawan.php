<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CutiKaryawan extends Model
{
    protected $table = 'cuti_karyawans'; // Nama tabel

    protected $fillable = ['id_cuti', 'id_user']; // Kolom yang bisa diisi massal

    // Relasi dengan model Cuti
    public function cuti()
    {
        return $this->belongsTo(Cuti::class, 'id_cuti');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
