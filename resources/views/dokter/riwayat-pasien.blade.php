@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Riwayat Pasien</h1>

    @if($riwayatPeriksa->isEmpty())
        <p>Tidak ada riwayat pemeriksaan.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Dokter</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatPeriksa as $index => $poli)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $poli->pasien->nama }}</td>
                        <td>{{ $poli->periksa->tgl_periksa ?? '-' }}</td>
                        <td>{{ $poli->jadwal_periksa->dokter->nama }}</td>
                        <td>{{ $poli->status }}</td>
                        <td>
                            <button onclick="document.getElementById('modal-{{ $poli->id }}').classList.remove('hidden')"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div id="modal-{{ $poli->id }}" class="fixed inset-0 bg-grey bg-opacity-100 flex justify-center items-center z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg relative w-full max-w-xl">
                            <button onclick="document.getElementById('modal-{{ $poli->id }}').classList.add('hidden')"
                                    class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl font-bold">&times;</button>

                            <h3 class="text-xl font-semibold mb-4">Detail Pemeriksaan</h3>

                            <p><strong>Nama Pasien:</strong> {{ $poli->pasien->nama }}</p>
                            <p><strong>Tanggal Periksa:</strong> {{ $poli->periksa->tgl_periksa ?? '-' }}</p>
                            <p><strong>Catatan:</strong> {{ $poli->periksa->catatan ?? '-' }}</p>
                            <p><strong>Biaya Pemeriksaan:</strong> Rp{{ number_format($poli->periksa->biaya_periksa ?? 0) }}</p>

                            @if($poli->periksa && $poli->periksa->detailPeriksa->count())
                                <div class="mt-4">
                                    <p class="font-semibold">Obat yang Diberikan:</p>
                                    <ul class="list-disc pl-5 text-gray-700">
                                        @foreach($poli->periksa->detailPeriksa as $detail)
                                            <li>{{ $detail->obat->nama_obat }} ({{ $detail->obat->kemasan }}) - Rp{{ number_format($detail->obat->harga) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 mt-2">Tidak ada obat tercatat.</p>
                            @endif
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>
    @endif
</div>
@endsection
