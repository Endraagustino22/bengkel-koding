<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;
use App\Models\Obat;

class DokterController extends Controller
{

    public function index()
    {
            // Ambil user yang sedang login + relasi periksa
            $user = User::with(['pasien', 'dokter'])->find(Auth::id());
    
            // Return ke view
            return view('dokter.dashboard', compact('user'));

    }

    public function periksa()
    {
        // Ambil user yang sedang login + relasi periksa
        $user = User::with(['pasien', 'dokter'])->find(Auth::id());

        // Return ke view
        return view('dokter.periksa', compact('user'));
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
        $periksa = Periksa::with('pasien')->findOrFail($id);
        return view('dokter.form-periksa', compact('periksa', 'obats'));
    }

    public function periksaStore(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'total_harga' => 'required|numeric',
        ]);

        // Ambil data periksa
        $periksa = Periksa::findOrFail($id);

        // Update data
        $periksa->update([
            'tgl_periksa' => $request->tanggal,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->total_harga,
            'status' => 'sudah diperiksa',
        ]);

        // Simpan obat yang dipilih
        if ($request->has('obat')) {
            $periksa->obat()->sync($request->obat);
        }

        // Redirect setelah update
        return redirect()->route('dokter.index')->with('success', 'Data periksa berhasil diperbarui.');
    }

}