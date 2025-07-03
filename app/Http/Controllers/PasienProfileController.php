<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienProfileController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('user')->get();
        return view('admin.pasien-profile.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien-profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp',
        ]);

        // Simpan data user
        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        // Format no_rm = TahunBulan + id_user, contoh: 20250642
        $no_rm = now()->format('Ym') . '-' . $user->id;

        // Simpan data pasien
        Pasien::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $no_rm,
        ]);

        return redirect()->route('pasien-profiles.index')->with('success', 'Pasien berhasil ditambahkan.');
    }


    public function edit(Pasien $pasien_profile)
    {
        $user = $pasien_profile->user;
        return view('admin.pasien-profile.edit', [
            'user' => $user,
            'pasien' => $pasien_profile,
        ]);
    }


    public function update(Request $request, Pasien $pasien_profile)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50|unique:users,no_hp,' . $pasien_profile->user->id,
            'email' => 'required|email|unique:users,email,' . $pasien_profile->user->id,
            'no_ktp' => 'required|string|max:255',
        ]);

        $pasien_profile->user->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        $pasien_profile->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
        ]);

        return redirect()->route('pasien-profiles.index')->with('success', 'Data pasien berhasil diperbarui.');
    }


    public function destroy(Pasien $pasien_profile)
    {
        $pasien_profile->user->delete();
        return redirect()->route('pasien-profiles.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
