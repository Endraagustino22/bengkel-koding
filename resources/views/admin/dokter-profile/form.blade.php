@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Data Pasien</h2>

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Data User --}}
        <h4>Data Akun</h4>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ $user->no_hp }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" required>{{ $user->alamat }}</textarea>
        </div>

        <hr>

        {{-- Data Pasien --}}
        <h4>Data Pasien</h4>

        <div class="mb-3">
            <label>No. KTP</label>
            <input type="text" class="form-control" name="no_ktp" value="{{ $pasien->no_ktp }}" required>
        </div>

        <div class="mb-3">
            <label>No. RM</label>
            <input type="text" class="form-control" name="no_rm" value="{{ $pasien->no_rm }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
