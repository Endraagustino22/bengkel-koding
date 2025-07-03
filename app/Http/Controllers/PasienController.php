<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Periksa;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\Poli;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pasien = Pasien::where('id_user', $user->id)->first();

        $pasien = Pasien::where('id_user', $user->id)->first();

        $riwayat = DB::table('periksa')
            ->join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('jadwal_periksas', 'daftar_poli.id_jadwal', '=', 'jadwal_periksas.id')
            ->join('dokter', 'jadwal_periksas.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('daftar_poli.id_pasien', $pasien->id)
            ->select(
                'periksa.tgl_periksa',
                'periksa.catatan',
                'periksa.biaya_periksa',
                'dokter.nama as nama_dokter',
                'poli.nama_poli',
                'daftar_poli.keluhan'
            )
            ->orderByDesc('periksa.tgl_periksa')
            ->get();

        return view('pasien.dashboard', compact('pasien', 'riwayat'));
    }

    public function showDaftarPoliForm()
    {
        $user = Auth::user();
        $pasien = Pasien::where('id_user', $user->id)->first();
        $poli = Poli::all();
        $jadwal = JadwalPeriksa::with(['dokter.poli'])->get();

        // Ambil daftar poli milik pasien ini
        $daftarPoli = DB::table('daftar_poli')
        ->join('jadwal_periksas', 'daftar_poli.id_jadwal', '=', 'jadwal_periksas.id')
        ->join('dokter', 'jadwal_periksas.id_dokter', '=', 'dokter.id')
        ->join('poli', 'dokter.id_poli', '=', 'poli.id')
        ->where('daftar_poli.id_pasien', $pasien->id)
        ->select(
            'daftar_poli.keluhan',
            'daftar_poli.no_antrian',
            'daftar_poli.status',
            'poli.nama_poli',
            'dokter.nama as nama_dokter',
            'jadwal_periksas.hari',
            'jadwal_periksas.jam_mulai',
            'jadwal_periksas.jam_selesai'
        )
        ->orderByDesc('daftar_poli.id')
        ->get();

        return view('pasien.daftar_poli', compact('pasien', 'poli', 'jadwal', 'daftarPoli'));
    }

    public function storeDaftarPoli(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasiens,id',
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
        ]);

        // Hitung antrian berdasarkan jadwal
        $no_antrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count() + 1;

        DaftarPoli::create([
            'id_pasien' => $request->id_pasien,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $no_antrian,
        ]);

        return redirect()->route('pasien.daftar_poli.form')->with('success', 'Berhasil daftar poli.');
    }

    // public function create()
    // {
    //     $dokters = User::where('role', 'dokter')->get();
    //     $user = Auth::user();
    //     $pemeriksaans = $user->pasien->load('dokter')->sortByDesc('tgl_periksa');

    //     return view('pasien.periksa', compact('dokters', 'pemeriksaans'));
    // }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_dokter' => 'required|exists:users,id',
    //     ]);

    //     Periksa::create([
    //         'id_pasien' => Auth::id(),
    //         'id_dokter' => $request->id_dokter,
    //         // bisa diisi default atau null untuk field lain
    //         'catatan' => 'belum ',
    //     ]);

    //     return redirect()->route('pasien.create')->with('success', 'Pemeriksaan berhasil didaftarkan.');
    // }
}
