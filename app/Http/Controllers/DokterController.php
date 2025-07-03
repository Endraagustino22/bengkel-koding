<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\DB;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;

class DokterController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::with('poli')->where('id_user', $user->id)->first();

        // Ambil daftar_poli yang ditangani oleh dokter ini
        $daftarPoli = DB::table('daftar_poli')
        ->join('jadwal_periksas', 'daftar_poli.id_jadwal', '=', 'jadwal_periksas.id')
        ->join('dokter', 'jadwal_periksas.id_dokter', '=', 'dokter.id')
        ->join('poli', 'dokter.id_poli', '=', 'poli.id')
        ->join('pasiens', 'daftar_poli.id_pasien', '=', 'pasiens.id')
        ->where('jadwal_periksas.id_dokter', $dokter->id)->where('daftar_poli.status', 'menunggu')
        ->select(
            'daftar_poli.id',
            'pasiens.nama as nama_pasien',
            'daftar_poli.no_antrian',
            'daftar_poli.keluhan',
            'poli.nama_poli',
            'jadwal_periksas.hari',
            'jadwal_periksas.jam_mulai',
            'jadwal_periksas.jam_selesai',
            'daftar_poli.status'
        )
        ->orderBy('daftar_poli.no_antrian')
        ->get();

        return view('dokter.dashboard', compact('dokter', 'daftarPoli'));
    }

    
    public function jadwal()
    {
        $jadwal = JadwalPeriksa::with('dokter.poli')->get();
        
        return view('dokter.jadwal.create', compact('jadwal'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_user', $user->id)->firstOrFail();
        $polis = Poli::all();

        return view('dokter.edit-profile', compact('dokter', 'polis'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_user', $user->id)->firstOrFail();

        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
        ]);

        return redirect()->route('dokter.edit-profile')->with('success', 'Profil berhasil diperbarui.');
    }

     public function periksa()
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_user', Auth::id())->firstOrFail();

        // Ambil user yang sedang login + relasi periksa
        $daftarPoli = DB::table('daftar_poli')
        ->join('jadwal_periksas', 'daftar_poli.id_jadwal', '=', 'jadwal_periksas.id')
        ->join('dokter', 'jadwal_periksas.id_dokter', '=', 'dokter.id')
        ->join('poli', 'dokter.id_poli', '=', 'poli.id')
        ->join('pasiens', 'daftar_poli.id_pasien', '=', 'pasiens.id')
        ->where('jadwal_periksas.id_dokter', $dokter->id)->where('daftar_poli.status', 'menunggu')
        ->select(
            'daftar_poli.id',
            'pasiens.nama as nama_pasien',
            'daftar_poli.no_antrian',
            'daftar_poli.keluhan',
            'poli.nama_poli',
            'jadwal_periksas.hari',
            'jadwal_periksas.jam_mulai',
            'jadwal_periksas.jam_selesai',
            'daftar_poli.status'
        )
        ->orderBy('daftar_poli.no_antrian')
        ->get();

        // Return ke view
        return view('dokter.periksa', compact('dokter', 'daftarPoli', 'user'));
    }


    public function editPeriksa($id)
    {
        // Ambil data periksa berdasarkan id
        $periksa = Periksa::findOrFail($id);
        
        // Return ke view edit, bawa data periksa
        return view('dokter.edit-periksa', compact('periksa'));
    }
    
    public function updatePeriksa(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'status' => 'required|in:sudah diperiksa,belum diperiksa',
        ]);
        
        // Ambil data periksa
        $periksa = Periksa::findOrFail($id);
        
        // Update data
        $periksa->update([
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
            'status' => $request->status,
        ]);
        
        // Redirect setelah update
        return redirect()->route('dokter.periksa')->with('success', 'Data periksa berhasil diperbarui.');
    }
    
    public function formPeriksa($id)
    {
         $obats = Obat::all();

        // Ambil daftar poli + relasi pasien
        $daftarPoli = DaftarPoli::with('pasien')->findOrFail($id);

        // Cek apakah sudah ada pemeriksaan
        $periksa = $daftarPoli->periksa;

        return view('dokter.form-periksa', [
            'daftarPoli' => $daftarPoli,
            'periksa' => $periksa,
            'obats' => $obats,
        ]);
    }
    
    public function periksaStore(Request $request, $id)
    {
        
        $request->merge([
            'total_harga' => str_replace(',', '', $request->total_harga)
        ]);
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
            'total_harga' => 'required|numeric',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $daftarPoli = DaftarPoli::findOrFail($id);
        // Simpan data periksa
        $periksa = Periksa::create([
            'id_daftar_poli' => $daftarPoli->id,
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->total_harga + 150000,
        ]);

        DaftarPoli::where('id', $daftarPoli->id)->update([
            'status' => 'diperiksa', // Update status menjadi diperiksa
        ]);


        // Simpan detail periksa untuk tiap obat
        if ($request->filled('obat_ids')) {
            foreach ($request->obat_ids as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }

        return redirect()->route('dokter.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function riwayatPasien()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $dokter = Dokter::where('id_user', $user->id)->firstOrFail();

        // Ambil daftar poli yang sudah diperiksa
        $riwayatPeriksa = DaftarPoli::with([
            'pasien',
            'periksa.detailPeriksa.obat',
            'jadwal_periksa.dokter'
        ])
        ->whereHas('jadwal_periksa', function ($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })
        ->where('status', '!=', 'menunggu')
        ->orderBy('created_at', 'desc')
        ->get();


        return view('dokter.riwayat-pasien', compact('riwayatPeriksa'));
    }
    
    // public function periksa()
    // {
    //     // Ambil user yang sedang login + relasi periksa
    //     $user = User::with(['pasien', 'dokter'])->find(Auth::id());
    
    //     // Return ke view
    //     return view('dokter.periksa', compact('user'));
    // }
}