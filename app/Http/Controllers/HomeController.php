<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();    // Menghitung jumlah user
        $officeCount = Office::count(); // Menghitung jumlah office
        $presensiCount = DB::table('presensi')->count(); // Menghitung jumlah presensi

        return view('dashboard', compact('userCount', 'officeCount', 'presensiCount'));
    }
    public function index()
    {
        $data = User::get();

        return view('index', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'required',
            'alamat' => 'required',
            'nik' => 'required|digits:16|numeric|unique:users,nik',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['jabatan'] = $request->jabatan;
        $data['alamat'] = $request->alamat;
        $data['no_hp'] = $request->no_hp;
        $data['nik'] = $request->nik;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'required',
            'alamat' => 'required',
            'nik' => 'required|digits:16|numeric',
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['jabatan'] = $request->jabatan;
        $data['no_hp'] = $request->no_hp;
        $data['alamat'] = $request->alamat;
        $data['nik'] = $request->nik;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.index');
    }
}
