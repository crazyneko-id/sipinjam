@extends('layouts.app')
@section('judul', 'Catat Peminjaman')

@section('konten')
  <div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Form Peminjaman Alat</h5>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Pilih Alat</label>
          <select name="alat_id" class="form-select">
            <option value="">-- Pilih Alat --</option>
            @foreach ($alats as $a)
              <option value="{{ $a->id }}" @selected(old('alat_id') == $a->id)>
                {{ $a->kode }} - {{ $a->nama }} (Stok: {{ $a->stok }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Peminjam</label>
          <input name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Pinjam</label>
          <input name="jumlah" type="number" class="form-control" value="{{ old('jumlah', 1) }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Pinjam</label>
          <input name="tanggal_pinjam" type="date" class="form-control" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
          <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection