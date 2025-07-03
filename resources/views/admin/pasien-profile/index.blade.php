@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Data Pasien</h1>
    <a href="{{ route('pasien-profiles.create') }}" class="btn btn-primary mb-3">Tambah Pasien</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>No KTP</th>
                <th>No RM</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>{{ $pasien->user->email ?? '-' }}</td>
                    <td>
                        <a href="{{ route('pasien-profiles.edit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pasien-profiles.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
