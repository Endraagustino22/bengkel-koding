@extends('layouts.main')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Daftar Periksa</h1>

        {{-- Daftar Pasien yang periksa --}}
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
                            <th class="border px-3 py-2">Aksi</th>
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
                                    <span>
                                        {{ $dp->status }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 text-xs rounded bg-orange-400">
                                        <a href="{{ route('dokter.form-periksa', $dp->id) }}" class="text-white">Periksa</a>
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
