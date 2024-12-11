<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cutis'; // Nama tabel

    protected $fillable = ['nama', 'jumlah_cuti']; // Kolom yang bisa diisi massal
}
