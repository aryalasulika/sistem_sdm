<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function absen()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('absensi.absensi', compact('users'));
    }
    public function userabsen()
    {
        $presensi = DB::table('presensi')->get();
        return view('absensi.userabsen', compact('presensi'));
    }
}
