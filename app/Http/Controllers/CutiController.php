<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Office;
use App\Models\Cuti;
use App\Models\CutiKaryawan;
use App\Models\KategoriCuti;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function cutiPage()
    {
        $data_cuti = DB::table('izin')
            ->join('users', 'izin.user_id', '=', 'users.id')
            ->select('izin.*', 'users.name', 'users.nik')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cuti.cuti', compact('data_cuti'));
    }

    public function tambahCuti()
    {
        $users = User::all();
        $kategori_cuti = KategoriCuti::all();
        return view('cuti.tambahCuti', compact('users', 'kategori_cuti'));
    }

    public function storeCuti(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required',
            'kategori_cuti' => 'required'
        ]);

        $tglMulai = Carbon::parse($request->tanggal_mulai);
        $tglSelesai = Carbon::parse($request->tanggal_selesai);
        $jumlahHari = $tglMulai->diffInDays($tglSelesai) + 1;

        DB::table('izin')->insert([
            'user_id' => $request->user_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'kategori_cuti' => $request->kategori_cuti,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.cuti')->with('success', 'Pengajuan cuti berhasil ditambahkan');
    }

    public function approve($id)
    {
        DB::table('izin')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.cuti')->with('success', 'Pengajuan cuti berhasil disetujui');
    }

    public function reject($id)
    {
        DB::table('izin')
            ->where('id', $id)
            ->update([
                'status' => 'rejected',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.cuti')->with('success', 'Pengajuan cuti berhasil ditolak');
    }

    public function destroy($id)
    {
        DB::table('izin')->where('id', $id)->delete();
        return redirect()->route('admin.cuti')->with('success', 'Data cuti berhasil dihapus');
    }



    // public function cutiPage()
    // {
    //     $data_cuti = DB::table('pengajuan_izin')->get();

    //     return view('cuti.cuti', compact('data_cuti'));
    // }

    // public function tambahCuti()
    // {
    //     $users = User::all();
    //     return view('cuti.tambahCuti', compact('users'));
    // }

}
