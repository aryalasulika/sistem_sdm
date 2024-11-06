<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'nama',
        'start_time',
        'end_time',
        'office_id',
    ];
}
