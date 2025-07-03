@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Pasien</h1>

    <form action="{{ route('pasien-profiles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" required>
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('pasien-profiles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
