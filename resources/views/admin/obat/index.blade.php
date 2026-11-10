<x-layouts.app title="Data Obat">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Data Obat</h1>
            <p class="mt-1 text-sm text-base-content/60">Kelola nama, jenis, kemasan, stok, harga, dan pemakaian obat pada resep.</p>
        </div>
        <a href="{{ route('admin.obat.create') }}" class="btn btn-primary">Tambah Obat</a>
    </div>

    @if (session('message'))
        <div class="alert {{ session('type') === 'error' ? 'alert-error' : 'alert-success' }} mb-5" role="status">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto rounded-box border border-base-300 bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Jenis</th>
                    <th>Kemasan</th>
                    <th class="text-right">Stok</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Detail Resep</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($obats as $obat)
                    <tr>
                        <td class="font-medium">{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->jenis_obat }}</td>
                        <td>{{ $obat->kemasan ?: '-' }}</td>
                        <td class="text-right">{{ $obat->stok }}</td>
                        <td class="text-right">Rp {{ number_format((float) $obat->harga, 0, ',', '.') }}</td>
                        <td class="text-right">{{ $obat->resep_details_count }}</td>
                        <td>
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.obat.edit', $obat) }}" class="btn btn-sm btn-outline">Edit</a>
                                @if ($obat->resep_details_count === 0)
                                    <form method="POST" action="{{ route('admin.obat.destroy', $obat) }}" onsubmit="return confirm('Hapus obat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error btn-outline">Hapus</button>
                                    </form>
                                @else
                                    <span class="badge badge-ghost">Dipakai resep</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-base-content/60">Belum ada data obat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $obats->links() }}</div>
</x-layouts.app>