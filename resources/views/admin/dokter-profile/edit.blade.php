@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Dokter</h1>

    <form action="{{ route('dokter-profiles.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Data User --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="form-control" required>
        </div>

        {{-- Data Dokter --}}
        <div class="mb-3">
            <label for="id_poli" class="form-label">Poli</label>
            <select name="id_poli" class="form-control" required>
                @foreach($polis as $poli)
                    <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
