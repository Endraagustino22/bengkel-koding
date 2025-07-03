@extends('layouts.main')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Dashboard Dokter</h1>

        {{-- Informasi Dokter --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-blue-50 rounded border">
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold text-lg">{{ $dokter->nama }}</p>
            </div>
            <div class="p-4 bg-blue-50 rounded border">
                <p class="text-sm text-gray-500">Poli</p>
                <p class="font-semibold text-lg">{{ $dokter->poli->nama_poli }}</p>
            </div>
            <div class="p-4 bg-blue-50 rounded border">
                <p class="text-sm text-gray-500">No. HP</p>
                <p class="font-semibold text-lg">{{ $dokter->no_hp }}</p>
            </div>
        </div>

        {{-- Daftar Pasien yang Terdaftar --}}
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Pasien Yang Belum Diperiksa</h2>
        @if ($daftarPoli->isEmpty())
            <p class="text-gray-500">Belum ada pasien yang mendaftar.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full table-auto border text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="border px-3 py-2">Antrian</th>
                            <th class="border px-3 py-2">Nama Pasien</th>
                            <th class="border px-3 py-2">Keluhan</th>
                            <th class="border px-3 py-2">Hari</th>
                            <th class="border px-3 py-2">Jam</th>
                            <th class="border px-3 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPoli as $dp)
                            <tr>
                                <td class="border px-3 py-2 text-center">{{ $dp->no_antrian }}</td>
                                <td class="border px-3 py-2">{{ $dp->nama_pasien }}</td>
                                <td class="border px-3 py-2">{{ $dp->keluhan }}</td>
                                <td class="border px-3 py-2">{{ $dp->hari }}</td>
                                <td class="border px-3 py-2">
                                    {{ \Carbon\Carbon::parse($dp->jam_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($dp->jam_selesai)->format('H:i') }}
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 text-xs text-white rounded
                                        {{ $dp->status === 'menunggu' ? 'bg-orange-400' : '' }}
                                        {{ $dp->status === 'diperiksa' ? 'bg-green-600' : '' }}
                                    ">
                                        {{ ucfirst($dp->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
