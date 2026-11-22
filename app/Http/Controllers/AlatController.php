<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Http\Requests\StoreAlatRequest;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:50'],
        ], [
            'q.max' => 'Kata kunci pencarian maksimal 50 karakter.',
        ]);

        $keyword = $validated['q'] ?? null;

        $alat = Alat::when($keyword, function ($query, $keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('kode')
            ->paginate(10)
            ->withQueryString();

        return view('alat.index', compact('alat', 'keyword'));
    }

    public function create()
    {
        return view('alat.create');
    }

    public function store(StoreAlatRequest $request)
    {
        Alat::create($request->validated());
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil ditambahkan.');
    }

    public function show(Alat $alat)
    {
        $alat->load('peminjamans');
        return view('alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        return view('alat.edit', compact('alat'));
    }

    public function update(StoreAlatRequest $request, Alat $alat)
    {
        $alat->update($request->validated());
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil dihapus.');
    }
}