<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriCuti extends Model
{
    protected $table = 'kategori_cutis'; // Nama tabel

    protected $fillable = ['nama', 'jumlah_cuti']; // Kolom yang bisa diisi massal
}
