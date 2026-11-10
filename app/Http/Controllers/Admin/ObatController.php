<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObatController extends Controller
{
    public function index(): View
    {
        $obats = Obat::query()
            ->withCount('resepDetails')
            ->orderBy('nama_obat')
            ->paginate(10);

        return view('admin.obat.index', compact('obats'));
    }

    public function create(): View
    {
        return view('admin.obat.create', ['obat' => new Obat()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Obat::create($this->validatedData($request));

        return redirect()
            ->route('admin.obat.index')
            ->with('message', 'Data obat berhasil ditambahkan.')
            ->with('type', 'success');
    }

    public function edit(Obat $obat): View
    {
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat): RedirectResponse
    {
        $obat->update($this->validatedData($request));

        return redirect()
            ->route('admin.obat.index')
            ->with('message', 'Data obat berhasil diperbarui.')
            ->with('type', 'success');
    }

    public function destroy(Obat $obat): RedirectResponse
    {
        if ($obat->resepDetails()->exists()) {
            return redirect()
                ->route('admin.obat.index')
                ->with('message', 'Obat sudah digunakan dalam resep dan tidak dapat dihapus.')
                ->with('type', 'error');
        }

        $obat->delete();

        return redirect()
            ->route('admin.obat.index')
            ->with('message', 'Data obat berhasil dihapus.')
            ->with('type', 'success');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama_obat' => ['required', 'string', 'max:255'],
            'jenis_obat' => ['required', 'string', 'max:255'],
            'kemasan' => ['required', 'string', 'max:100'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);
    }
}