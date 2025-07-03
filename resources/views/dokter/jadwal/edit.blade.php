@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Edit Jadwal Periksa</h2>

    {{-- Notifikasi error --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @php
            $isToday = strtolower($jadwal->hari) == strtolower(now()->locale('id')->dayName);
        @endphp

        <div>
            <label class="block text-sm font-medium text-gray-700">Dokter</label>
            <select name="id_dokter" class="w-full border rounded p-2" {{ $isToday ? 'disabled' : '' }} required>
                @foreach ($dokter as $d)
                    <option value="{{ $d->id }}" {{ $d->id == $jadwal->id_dokter ? 'selected' : '' }}>
                        {{ $d->nama }} ({{ $d->poli->nama_poli }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Hari</label>
            <select name="hari" class="w-full border rounded p-2" {{ $isToday ? 'disabled' : '' }} required>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>
                        {{ $hari }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" class="w-full border rounded p-2" {{ $isToday ? 'disabled' : '' }} required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" class="w-full border rounded p-2" {{ $isToday ? 'disabled' : '' }} required>
            </div>
        </div>

        @if ($isToday)
            <p class="text-sm text-red-600 italic">* Jadwal tidak dapat diubah karena hari ini adalah hari pelaksanaannya.</p>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Status Jadwal</label>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="aktif" {{ $jadwal->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $jadwal->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>


        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" {{ $isToday ? 'disabled' : '' }}>
            Update
        </button>
        <a href="{{ route('jadwal.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
