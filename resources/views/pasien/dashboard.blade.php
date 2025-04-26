@extends('layouts.main')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard Pasien</h2>

    {{-- Informasi Pasien --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $user->nama }}</h5>
            <p class="card-text">
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>No HP:</strong> {{ $user->no_hp }}<br>
                <strong>Alamat:</strong> {{ $user->alamat }}
            </p>
        </div>
    </div>

    {{-- Statistik Pemeriksaan --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-light border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pemeriksaan</h5>
                    <p class="display-6">{{ $jumlahPeriksa }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light border-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Biaya</h5>
                    <p class="display-6">Rp{{ number_format($totalBiaya, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat Pemeriksaan --}}
    <div class="card">
        <div class="card-header">
            Riwayat Pemeriksaan
        </div>
        <div class="card-body">
            @if ($pemeriksaans->isEmpty())
                <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Catatan</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemeriksaans as $periksa)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                                    <td>{{ $periksa->dokter->nama ?? 'Tidak Diketahui' }}</td>
                                    <td>{{ $periksa->catatan }}</td>
                                    <td>Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
