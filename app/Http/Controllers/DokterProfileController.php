<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterProfileController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poli', 'user')->get();
        return view('admin.dokter-profile.index', compact('dokters'));
    }

    public function create()
    {
        $users = User::where('role', 'dokter')->get(); // hanya user role dokter
        $polis = Poli::all();
        return view('admin.dokter-profile.create', compact('users', 'polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:50|unique:users,no_hp',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
        ]);

        // Simpan user baru
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'dokter', // default role dokter
        ]);

        // Simpan data dokter yang berelasi dengan user
        Dokter::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
        ]);

        return redirect()->route('dokter-profiles.index')->with('success', 'Dokter berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $dokter = Dokter::where('id_user', $id)->firstOrFail();
        $polis = Poli::all();

        return view('admin.dokter-profile.edit', compact('user', 'dokter', 'polis'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'id_poli' => 'required|exists:poli,id',
        ]);

        // Ambil data user & dokter terkait
        $user = User::findOrFail($id);
        $dokter = Dokter::where('id_user', $id)->firstOrFail();

        // Update data user
        $user->update([
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
        ]);

        // Update data dokter
        $dokter->update([
            'nama'   => $request->nama,
            'no_hp'  => $request->no_hp,
            'id_poli' => $request->id_poli,
        ]);

        return redirect()->route('dokter-profiles.index')->with('success', 'Data dokter berhasil diperbarui.');
    }



    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('dokter-profiles.index')->with('success', 'Dokter berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }

}
