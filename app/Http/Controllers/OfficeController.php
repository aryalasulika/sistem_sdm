<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Office;
use App\Models\Shift;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class OfficeController extends Controller
{
    public function klinik()
    {
        $data_klinik = Office::get();

        return view('klinik.klinik', compact('data_klinik'));
    }
    public function klinik_shift()
    {
        return view('klinik.klinik_shift');
    }


    // public function data_perusahaan(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [

    //         'nama' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //         'radius' => 'required',
    //     ]);

    //     if ($validator->fails())
    //         return redirect()->back()->withInput()->withErrors($validator);

    //     $data_klinik['name'] = $request->nama;
    //     $data_klinik['latitude'] = $request->latitude;
    //     $data_klinik['longitude'] = $request->longitude;
    //     $data_klinik['radius'] = $request->radius;

    //     Office::create($data_klinik);

    //     return redirect()->route('admin.klinik');
    // }

    public function saveData(Request $request)
    {
        // dd($request->all());

        // Validasi data perusahaan (office)
        $officeValidator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'radius' => 'required',
        ]);

        // Validasi data shift
        $shiftValidator = Validator::make($request->all(), [
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ]);

        // Jika validasi data office gagal
        if ($officeValidator->fails()) {
            return redirect()->back()->withInput()->withErrors($officeValidator);
        }

        // Jika validasi data shift gagal
        if ($shiftValidator->fails()) {
            return redirect()->back()->withInput()->withErrors($shiftValidator);
        }

        // Menyimpan data perusahaan (office)
        $data_office = [
            'name' => $request->nama,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'radius' => $request->radius,
        ];
        Office::create($data_office);

        // Menyimpan data shift
        $data_shift = [
            'nama' => $request->nama_shift,
            'start_time' => $request->jam_masuk,
            'end_time' => $request->jam_keluar,
        ];
        Shift::create($data_shift);

        // Redirect ke halaman yang sesuai setelah menyimpan
        return redirect()->route('admin.klinik')->with('success', 'Data perusahaan dan shift berhasil disimpan.');
    }

    public function editKlinik(Request $request, $id)
    {
        $data_office = Office::find($id);

        return view('klinik.edit_klinik', compact('data_office'));
    }

    public function updateKlinik(Request $request, $id)
    {
        $officeValidator = Validator::make($request->all(), [
            'nama' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'radius' => 'required',
        ]);

        if ($officeValidator->fails()) {
            return redirect()->back()->withInput()->withErrors($officeValidator);
        }

        // Siapkan data untuk update
        $data_office = [
            'name' => $request->nama,
            'latitude' => $request->lat,
            'longitude' => $request->lon,
            'radius' => $request->radius,
        ];
        // $data_shift['nama'] = $request->nama_shift;
        // $data_shift['start_time'] = $request->jam_masuk;
        // $data_shift['end_time'] = $request->jam_keluar;

        // Update data_shift shift dengan array $data
        Office::whereId($id)->update($data_office);

        return redirect()->route('admin.klinik');
    }

    public function deleteKlinik(Request $request, $id)
    {
        $data_office = Office::find($id);

        if ($data_office) {
            $data_office->delete();
        }
        return redirect()->route('admin.klinik');
    }
}

