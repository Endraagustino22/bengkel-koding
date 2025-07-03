@extends('layouts.main')

@section('content')

@if (session('success'))
    <div class="mb-4 p-4 rounded-md bg-green-100 border border-green-300 text-green-800">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto p-6 bg-white shadow-md rounded-lg px-5">
    <h1 class="text-xl font-bold mb-4 text-blue-600">Dashboard Pasien</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 border rounded-lg bg-blue-50">
            <p class="text-gray-600">Nama</p>
            <p class="font-semibold">{{ $pasien->nama }}</p>
        </div>
        <div class="p-4 border rounded-lg bg-blue-50">
            <p class="text-gray-600">No. Rekam Medis (RM)</p>
            <p class="font-semibold">{{ $pasien->no_rm }}</p>
        </div>
        <div class="p-4 border rounded-lg bg-blue-50">
            <p class="text-gray-600">No. HP</p>
            <p class="font-semibold">{{ $pasien->no_hp }}</p>
        </div>
        <div class="p-4 border rounded-lg bg-blue-50">
            <p class="text-gray-600">Alamat</p>
            <p class="font-semibold">{{ $pasien->alamat }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h1 class="text-xl font-bold mb-4 text-blue-600">Riwayat Pariksa</h1>
        @if($riwayat->isEmpty())
        <p class="text-gray-500">Belum ada riwayat periksa.</p>
        @else
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-blue-100 text-left">
                        <th class="p-2 border">Tanggal Periksa</th>
                        <th class="p-2 border">Keluhan</th>
                        <th class="p-2 border">Catatan</th>
                        <th class="p-2 border">Dokter</th>
                        <th class="p-2 border">Poli</th>
                        <th class="p-2 border">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $item)
                        <tr class="border-t">
                            <td class="p-2 border">{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d/m/Y H:i') }}</td>
                            <td class="p-2 border">{{ $item->keluhan }}</td>
                            <td class="p-2 border">{{ $item->catatan }}</td>
                            <td class="p-2 border">{{ $item->nama_dokter }}</td>
                            <td class="p-2 border">{{ $item->nama_poli }}</td>
                            <td class="p-2 border">Rp{{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @endif           
    </div>
            <div class="mt-6">
                <a href="{{ route('logout') }}" 
                class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                Logout
                </a>
            </div>
</div>

@endsection