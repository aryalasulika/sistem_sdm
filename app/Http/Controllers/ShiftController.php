<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ShiftController extends Controller
{
    public function shift()
    {
        $data_shift = Shift::get();

        return view('shift.shift', compact('data_shift'));
    }

    public function klinik_shift()
    {
        return view('klinik.klinik_shift');
    }


    public function data_shift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $data_shift['nama'] = $request->nama_shift;
        $data_shift['start_time'] = $request->jam_masuk;
        $data_shift['end_time'] = $request->Jam_keluar;

        Shift::create($data_shift);

        return redirect()->route('admin.shift');
    }
}
