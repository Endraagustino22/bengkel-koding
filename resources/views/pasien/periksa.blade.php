@extends('layouts.main')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Pilih Dokter untuk Pemeriksaan</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Pendaftaran Pemeriksaan --}}
    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_dokter" class="form-label">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" class="form-select" required>
                <option value="" disabled selected>-- Pilih Dokter --</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Daftar Pemeriksaan</button>
    </form>

    {{-- Tabel Pemeriksaan --}}
    <hr class="my-5">
    <h4>Riwayat Pemeriksaan</h4>
    @if ($pemeriksaans->isEmpty())
        <p>Belum ada pemeriksaan yang terdaftar.</p>
    @else
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Dokter</th>
                <th>Tanggal Periksa</th>
                <th>Catatan</th>
                <th>Biaya</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemeriksaans as $index => $periksa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $periksa->dokter->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}</td>
                    <td>{{ $periksa->catatan ?? '-' }}</td>
                    <td>Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                    <td>{{ $periksa->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
