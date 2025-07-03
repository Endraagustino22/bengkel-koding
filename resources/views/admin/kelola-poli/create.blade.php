@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Poli</h1>

    <form action="{{ route('poli.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Poli</label>
            <input type="text" name="nama_poli" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
