<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function absen()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('absensi.absensi', compact('users'));
    }
}
