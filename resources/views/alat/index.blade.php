@extends('layouts.app')
@section('judul', 'Daftar Alat')

@section('konten')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Alat</h3>
    <a href="{{ route('alat.create') }}" class="btn btn-primary">+ Tambah Alat</a>
  </div>

  @if (session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
  @endif

  @error('q')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <form method="GET" action="{{ route('alat.index') }}" class="row g-2 mb-3">
    <div class="col-md-5">
      <input type="text" name="q" value="{{ $keyword ?? '' }}" class="form-control" placeholder="Cari nama alat...">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-secondary">Cari</button>
      @if (!empty($keyword))
        <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Reset</a>
      @endif
    </div>
  </form>

  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0 align-middle">
        <thead class="table-dark">
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th width="210">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($alat as $a)
            <tr>
              <td>{{ $a->kode }}</td>
              <td>{{ $a->nama }}</td>
              <td>
                @if ($a->stok == 0)
                  <span class="text-danger fw-bold">{{ $a->stok }}</span>
                @else
                  {{ $a->stok }}
                @endif
              </td>
              <td>{{ $a->kondisi }}</td>
              <td>{{ $a->lokasi ?? '-' }}</td>
              <td>
                <a href="{{ route('alat.show', $a) }}" class="btn btn-info btn-sm text-white">Detail</a>
                <a href="{{ route('alat.edit', $a) }}" class="btn btn-warning btn-sm">Ubah</a>
                <form method="POST" action="{{ route('alat.destroy', $a) }}"
                      class="d-inline"
                      onsubmit="return confirm('Hapus alat ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-3">Belum ada data alat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">
    {{ $alat->links() }}
  </div>
@endsection