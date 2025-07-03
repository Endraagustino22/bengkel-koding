@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Data Dokter</h1>
    <a href="{{ route('dokter-profiles.create') }}" class="btn btn-primary mb-3">Tambah Dokter</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
                <tr>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->alamat }}</td>
                    <td>{{ $dokter->no_hp }}</td>
                    <td>{{ $dokter->poli->nama_poli ?? '-' }}</td>
                    <td>
                        <a href="{{ route('dokter-profiles.edit', $dokter->user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('dokter-profiles.destroy', $dokter->user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus dokter ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
