@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-md shadow-md">
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-6 text-blue-700">Daftar Poli</h2>

    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-6">
        {{-- Form Pendaftaran --}}
        <form method="POST" action="{{ route('pasien.daftar_poli.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="id_pasien" value="{{ $pasien->id }}">

            {{-- Dropdown Poli --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Poli</label>
                <select id="poliSelect" class="w-full border rounded-md p-2" required>
                    <option value="" disabled selected>-- Pilih Poli --</option>
                    @foreach ($poli as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Dropdown Jadwal Poli --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Jadwal Poli</label>
                <select name="id_jadwal" id="jadwalSelect" class="w-full border rounded-md p-2" required>
                    <option value="" disabled selected>-- Pilih Jadwal --</option>
                    @foreach ($jadwal as $j)
                        <option value="{{ $j->id }}" data-poli="{{ $j->dokter->poli->id }}">
                            {{ $j->dokter->nama }} ({{ $j->dokter->poli->nama_poli }}) - 
                            {{ $j->hari }} 
                            {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                <textarea name="keluhan" rows="4" class="w-full border rounded-md p-2" required></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Daftar
                </button>
            </div>
        </form>

        {{-- Daftar Poli yang Sudah Didaftarkan --}}
        <div class="overflow-x-auto">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">Riwayat Pendaftaran Poli</h3>
            @if ($daftarPoli->isEmpty())
                <p class="text-gray-500">Belum ada pendaftaran poli.</p>
            @else
                <table class="w-full table-auto border border-gray-300 text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr class="min-h-[40px]">
                            <th class="border px-2 py-1">No Antrian</th>
                            <th class="border px-2 py-1">Poli</th>
                            <th class="border px-2 py-1">Dokter</th>
                            <th class="border px-2 py-1">Hari</th>
                            <th class="border px-2 py-1">Jam</th>
                            <th class="border px-2 py-1">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPoli as $dp)
                            <tr>
                                <td class="border px-2 py-1 text-center">{{ $dp->no_antrian }}</td>
                                <td class="border px-2 py-1">{{ $dp->nama_poli }}</td>
                                <td class="border px-2 py-1">{{ $dp->nama_dokter }}</td>
                                <td class="border px-2 py-1">{{ $dp->hari }}</td>
                                <td class="border px-2 py-1">
                                    {{ \Carbon\Carbon::parse($dp->jam_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($dp->jam_selesai)->format('H:i') }}
                                </td>

                                @if($dp->status == 'menunggu')
                                    <td class="border px-2 py-1 "><span class="bg-orange-400 px-3 rounded text-white">{{ $dp->status }}</span></td>
                                @elseif($dp->status == 'diperiksa')
                                    <td class="border px-2 py-1 "><span class="bg-green-600 px-3 rounded text-white">{{ $dp->status }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>
@endsection


{{-- Tambahkan JS filter jadwal sesuai poli --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const poliSelect = document.getElementById('poliSelect');
        const jadwalSelect = document.getElementById('jadwalSelect');

        poliSelect.addEventListener('change', function () {
            const selectedPoli = this.value;

            Array.from(jadwalSelect.options).forEach(option => {
                if (option.value === '') return;
                const poliId = option.getAttribute('data-poli');
                option.style.display = poliId === selectedPoli ? 'block' : 'none';
            });

            jadwalSelect.value = '';
        });
    });
</script>
