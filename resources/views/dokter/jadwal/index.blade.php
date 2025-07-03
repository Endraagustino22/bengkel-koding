@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Jadwal Periksa</h1>

    <div class="mb-3 inline-block bg-blue-600 text-white px-4 py-2 rounded">
        <a href="{{ route('jadwal.create') }}" class="text-white">Tambah Jadwal</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 p-2 rounded mb-4 text-green-800">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 p-2 rounded mb-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full table-auto border">
        <thead class="bg-blue-100">
            <tr>
                <th class="border p-2">Dokter</th>
                <th class="border p-2">Hari</th>
                <th class="border p-2">Jam</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $j)
                <tr class="bg-white hover:bg-gray-100">
                    <td class="border p-2">{{ $j->dokter->nama }}</td>
                    <td class="border p-2">{{ $j->hari }}</td>
                    <td class="border p-2">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                    <td class="border p-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $j->status == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($j->status) }}
                        </span>
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('jadwal.edit', $j->id) }}" class="d">Edit</a>

                        {{-- Tombol hapus dinonaktifkan --}}
                        <button disabled class="bg-gray-400 text-white px-3 py-1 rounded ml-2 cursor-not-allowed" title="Tidak dapat menghapus jadwal">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
