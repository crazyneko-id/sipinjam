<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')->latest()->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->orderBy('nama')->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'alat_id'        => ['required', 'exists:alats,id'],
            'nama_peminjam'  => ['required', 'string', 'min:3', 'max:100'],
            'jumlah'         => ['required', 'integer', 'min:1'],
            'tanggal_pinjam' => ['required', 'date'],
        ], [
            'alat_id.required'        => 'Pilih alat yang akan dipinjam.',
            'nama_peminjam.required'  => 'Nama peminjam wajib diisi.',
            'nama_peminjam.min'       => 'Nama peminjam minimal 3 karakter.',
            'jumlah.min'              => 'Jumlah pinjam minimal 1.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
        ]);

        $alat = Alat::findOrFail($data['alat_id']);

        if ($data['jumlah'] > $alat->stok) {
            return back()
                ->withErrors(['jumlah' => 'Jumlah pinjam melebihi stok tersedia (' . $alat->stok . ').'])
                ->withInput();
        }

        $data['status'] = 'dipinjam';
        Peminjaman::create($data);
        $alat->decrement('stok', $data['jumlah']);

        return redirect()->route('peminjaman.index')
            ->with('sukses', 'Data peminjaman berhasil dicatat.');
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->update(['status' => 'dikembalikan']);
            $peminjaman->alat->increment('stok', $peminjaman->jumlah);
        }

        return redirect()->route('peminjaman.index')
            ->with('sukses', 'Alat telah dikembalikan dan stok diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->alat->increment('stok', $peminjaman->jumlah);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('sukses', 'Data peminjaman berhasil dihapus.');
    }
}