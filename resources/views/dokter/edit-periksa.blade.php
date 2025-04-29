@extends('layouts.main')
@section('title', 'Edit Periksa')
@section('content-header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Data Periksa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Periksa</li>
        </ol>
      </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Periksa</h3>
                </div>
                <form action="{{ route('dokter.update-periksa', $periksa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Periksa</label>
                            <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" value="{{ $periksa->tgl_periksa }}" required>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" required>{{ $periksa->catatan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="biaya_periksa">Biaya Periksa</label>
                            <input type="number" class="form-control" id="biaya_periksa" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="sudah diperiksa" {{ $periksa->status == 'sudah diperiksa' ? 'selected' : '' }}>sudah diperiksa</option>
                                <option value="belum diperiksa" {{ $periksa->status == 'belum diperiksa' ? 'selected' : '' }}>belum diperiksa</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update Periksa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
