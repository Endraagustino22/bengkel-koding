@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Edit Data Pasien</h1>

    <form action="{{ route('pasien-profiles.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pasien->user->email ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ $pasien->no_ktp }}" required>
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('pasien-profiles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
