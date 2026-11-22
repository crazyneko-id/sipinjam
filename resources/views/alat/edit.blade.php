@extends('layouts.app')
@section('judul', 'Ubah Alat')

@section('konten')
  <div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-warning">
      <h5 class="mb-0">Ubah Data Alat</h5>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('alat.update', $alat) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">Kode</label>
          <input name="kode" class="form-control" value="{{ old('kode', $alat->kode) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input name="nama" class="form-control" value="{{ old('nama', $alat->nama) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Stok</label>
          <input name="stok" type="number" class="form-control" value="{{ old('stok', $alat->stok) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Kondisi</label>
          <select name="kondisi" class="form-select">
            <option value="baik" @selected(old('kondisi', $alat->kondisi) == 'baik')>baik</option>
            <option value="rusak ringan" @selected(old('kondisi', $alat->kondisi) == 'rusak ringan')>rusak ringan</option>
            <option value="rusak berat" @selected(old('kondisi', $alat->kondisi) == 'rusak berat')>rusak berat</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input name="lokasi" class="form-control" value="{{ old('lokasi', $alat->lokasi) }}">
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-warning">Perbarui</button>
          <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection