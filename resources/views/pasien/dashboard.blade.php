@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-semibold mb-6">Dashboard Pasien</h2>

    {{-- Informasi Pasien --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold mb-2">{{ $user->nama }}</h3>
        <p class="text-gray-700">
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>No HP:</strong> {{ $user->no_hp }}<br>
            <strong>Alamat:</strong> {{ $user->alamat }}
        </p>
    </div>

    {{-- Statistik Pemeriksaan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-green-500 text-white rounded-lg shadow-md p-6 text-center">
            <h4 class="text-lg font-semibold mb-2">Total Pemeriksaan</h4>
            <p class="text-5xl font-bold">{{ $jumlahPeriksa }}</p>
        </div>
        <div class="bg-green-100 text-green-800 rounded-lg shadow-md p-6 text-center">
            <h4 class="text-lg font-semibold mb-2">Total Biaya</h4>
            <p class="text-3xl font-bold">Rp{{ number_format($totalBiaya, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Riwayat Pemeriksaan --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="px-6 py-4 border-b">
            <h5 class="text-lg font-semibold">Riwayat Pemeriksaan</h5>
        </div>
        <div class="p-6">
            @if ($pemeriksaans->isEmpty())
                <p class="text-gray-500">Belum ada riwayat pemeriksaan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Tanggal</th>
                                <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Dokter</th>
                                <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Catatan</th>
                                <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($pemeriksaans as $periksa)
                                <tr>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2">{{ $periksa->dokter->nama ?? 'Tidak Diketahui' }}</td>
                                    <td class="px-4 py-2">{{ $periksa->catatan }}</td>
                                    <td class="px-4 py-2">Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
