<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // dokter yang sedang login
        $pemeriksaans = $user->pemeriksaanSebagaiDokter->load('pasien')->orderByDesc('tgl_periksa')->get();

        return view('dokter.dashboard', compact('user', 'pemeriksaans'));
    }
}