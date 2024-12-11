<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Office;
use App\Models\Cuti;
use App\Models\CutiKaryawan;
use App\Models\KategoriCuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function cutiPage()
    {
        $data_cuti = KategoriCuti::get();

        return view('cuti.cuti', compact('data_cuti'));
    }

    public function tambahCuti()
    {
        $users = User::all();
        return view('cuti.tambahCuti', compact('users'));
    }

}
