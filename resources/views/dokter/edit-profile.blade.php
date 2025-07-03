@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Edit Profil Saya</h2>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('dokter.update-profile') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $dokter->nama) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required>{{ old('alamat', $dokter->alamat) }}</textarea>
        </div>

        <div>
            <label class="block text-sm">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm">Poli</label>
            <select name="id_poli" class="w-full border rounded p-2" required>
                @foreach ($polis as $p)
                    <option value="{{ $p->id }}" {{ $dokter->id_poli == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_poli }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="pt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
