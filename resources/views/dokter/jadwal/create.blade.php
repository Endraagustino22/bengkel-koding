@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Tambah Jadwal Periksa</h2>

    {{-- Notifikasi error --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Dokter</label>
            <select name="id_dokter" class="w-full border rounded p-2" required>
                <option value="" disabled selected>-- Pilih Dokter --</option>
                @foreach ($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }} ({{ $d->poli->nama_poli }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Hari</label>
            <select name="hari" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Hari --</option>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}">{{ $hari }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="w-full border rounded p-2" required>
            </div>
        </div>

        <p class="text-sm text-gray-500 italic">
            * Jadwal aktif akan otomatis ditentukan. Jika sudah ada jadwal aktif, yang baru akan non-aktif.
        </p>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
        <a href="{{ route('jadwal.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
