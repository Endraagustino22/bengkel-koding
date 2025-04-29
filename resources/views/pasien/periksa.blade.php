@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 bg-blue-100 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Pilih Dokter untuk Pemeriksaan</h2>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi Error --}}
    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Pendaftaran Pemeriksaan --}}
    <form action="{{ route('pasien.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="id_dokter" class="block text-sm font-medium text-gray-700 mb-1">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" required class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-300 focus:ring-gray-500 focus:border-green-500 py-2 px-3">
                <option value="" disabled selected>-- Pilih Dokter --</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Daftar Pemeriksaan</button>
    </form>

    {{-- Tabel Pemeriksaan --}}
    <hr class="my-10 border-gray-300">
    <h4 class="text-xl font-semibold mb-4">Riwayat Pemeriksaan</h4>

    @if ($pemeriksaans->isEmpty())
        <p class="text-gray-500">Belum ada pemeriksaan yang terdaftar.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Dokter</th>
                        <th class="px-4 py-2">Tanggal Periksa</th>
                        <th class="px-4 py-2">Catatan</th>
                        <th class="px-4 py-2">Biaya</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 divide-y divide-gray-200">
                    @foreach ($pemeriksaans as $index => $periksa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $periksa->dokter->nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $periksa->catatan ?? '-' }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $periksa->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
