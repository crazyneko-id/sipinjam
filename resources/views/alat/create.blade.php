@extends('layouts.app')
@section('judul', 'Tambah Alat')

@section('konten')
  <div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Tambah Alat Baru</h5>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('alat.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Kode</label>
          <input name="kode" class="form-control" value="{{ old('kode') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input name="nama" class="form-control" value="{{ old('nama') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Stok</label>
          <input name="stok" type="number" class="form-control" value="{{ old('stok') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Kondisi</label>
          <select name="kondisi" class="form-select">
            <option value="baik" @selected(old('kondisi') == 'baik')>baik</option>
            <option value="rusak ringan" @selected(old('kondisi') == 'rusak ringan')>rusak ringan</option>
            <option value="rusak berat" @selected(old('kondisi') == 'rusak berat')>rusak berat</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input name="lokasi" class="form-control" value="{{ old('lokasi') }}">
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection