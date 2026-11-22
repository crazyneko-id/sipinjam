@extends('layouts.app')
@section('judul', 'Data Peminjaman')

@section('konten')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Data Peminjaman Alat</h3>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">+ Catat Peminjaman</a>
  </div>

  @if (session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0 align-middle">
        <thead class="table-dark">
          <tr>
            <th>Alat</th>
            <th>Nama Peminjam</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
            <th width="200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($peminjamans as $p)
            <tr>
              <td>{{ $p->alat->kode }} - {{ $p->alat->nama }}</td>
              <td>{{ $p->nama_peminjam }}</td>
              <td>{{ $p->jumlah }}</td>
              <td>{{ $p->tanggal_pinjam }}</td>
              <td>
                <span class="badge {{ $p->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                  {{ $p->status }}
                </span>
              </td>
              <td>
                @if ($p->status == 'dipinjam')
                  <form method="POST" action="{{ route('peminjaman.update', $p) }}" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                  </form>
                @endif
                <form method="POST" action="{{ route('peminjaman.destroy', $p) }}"
                      class="d-inline"
                      onsubmit="return confirm('Hapus data peminjaman ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-3">Belum ada data peminjaman.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">
    {{ $peminjamans->links() }}
  </div>
@endsection