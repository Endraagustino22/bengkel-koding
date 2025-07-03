<?php
namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPeriksa::with('dokter')->where('id_dokter', Auth::user()->id)->get();
        return view('dokter.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        if(Auth::user()->role== 'dokter') {
            $dokter = Dokter::where('id', Auth::user()->id)->get();
        }elseif(Auth::user()->role == 'admin') {
            $dokter = Dokter::all();
        } else {
            return redirect()->route('jadwal.index')->with('error', 'Akses ditolak.');
        }
        return view('dokter.jadwal.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Periksa tabrakan jadwal dengan dokter yang sama
        $bentrok = JadwalPeriksa::where('id_dokter', $request->id_dokter)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_mulai)
                            ->where('jam_selesai', '>', $request->jam_selesai);
                    });
            })->exists();

        if ($bentrok) {
            return back()->with('error', 'Jadwal bertabrakan dengan jadwal lain.');
        }

        // Cek jika sudah ada jadwal aktif
        $sudahAdaAktif = JadwalPeriksa::where('id_dokter', $request->id_dokter)
            ->where('status', 'aktif')
            ->exists();

        $status = $sudahAdaAktif ? 'non-aktif' : 'aktif';

        JadwalPeriksa::create([
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $status,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        if(Auth::user()->role == 'dokter') {
            $dokter = Dokter::where('id', Auth::user()->id)->get();
        } elseif (Auth::user()->role == 'admin') {
            $dokter = Dokter::all();
        } else {
            return redirect()->route('jadwal.index')->with('error', 'Akses ditolak.');
        }
        return view('dokter.jadwal.edit', compact('jadwal', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Cek apakah hari ini adalah hari H jadwal, jika iya, tolak perubahan hari dan jam
        $today = now()->format('l'); // contoh: 'Monday'
        $hariInput = ucfirst(strtolower($request->hari)); // formatkan agar 'Senin' == 'Senin'
        $hariNow = match($today) {
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        };

        if ($hariInput == $hariNow) {
            return redirect()->back()->with('error', 'Tidak dapat mengubah jadwal pada hari H!');
        }

        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Jika status = aktif, nonaktifkan jadwal aktif lainnya dari dokter yang sama
        if ($request->status == 'aktif') {
            JadwalPeriksa::where('id_dokter', $request->id_dokter)
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => 'tidak aktif']);
        }

        // Update data
        $jadwal->update([
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }


    public function destroy($id)
    {
        JadwalPeriksa::destroy($id);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
