<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Periksa;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemeriksaans = $user->pasien->load('dokter')->sortByDesc('tgl_periksa');
        $jumlahPeriksa = $pemeriksaans->count();
        $totalBiaya = $pemeriksaans->sum('biaya_periksa');

        return view('pasien.dashboard', compact('user', 'pemeriksaans', 'jumlahPeriksa', 'totalBiaya'));
    }

    public function create()
    {
        $dokters = User::where('role', 'dokter')->get();
        $user = Auth::user();
        $pemeriksaans = $user->pasien->load('dokter')->sortByDesc('tgl_periksa');

        return view('pasien.periksa', compact('dokters', 'pemeriksaans'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
        ]);

        Periksa::create([
            'id_pasien' => Auth::id(),
            'id_dokter' => $request->id_dokter,
            // bisa diisi default atau null untuk field lain
            'catatan' => 'belum ',
        ]);

        return redirect()->route('pasien.create')->with('success', 'Pemeriksaan berhasil didaftarkan.');
    }
}
