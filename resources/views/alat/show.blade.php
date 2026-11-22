@extends('layouts.app')
@section('judul', 'Detail Alat')

@section('konten')
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-info text-white">
      <h5 class="mb-0">Detail Alat: {{ $alat->nama }}</h5>
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"><strong>Kode:</strong> {{ $alat->kode }}</li>
        <li class="list-group-item"><strong>Nama:</strong> {{ $alat->nama }}</li>
        <li class="list-group-item"><strong>Stok:</strong> {{ $alat->stok }}</li>
        <li class="list-group-item"><strong>Kondisi:</strong> {{ $alat->kondisi }}</li>
        <li class="list-group-item"><strong>Lokasi:</strong> {{ $alat->lokasi ?? '-' }}</li>
      </ul>
      <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h6 class="mb-0">Riwayat Peminjaman Alat Ini</h6>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Peminjam</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($alat->peminjamans as $p)
            <tr>
              <td>{{ $p->nama_peminjam }}</td>
              <td>{{ $p->jumlah }}</td>
              <td>{{ $p->tanggal_pinjam }}</td>
              <td>
                <span class="badge {{ $p->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                  {{ $p->status }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted">Belum ada riwayat peminjaman untuk alat ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection