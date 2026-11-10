<x-layouts.app title="Edit Obat">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Obat</h1>
        <p class="mt-1 text-sm text-base-content/60">Perbarui informasi {{ $obat->nama_obat }}.</p>
    </div>

    <form method="POST" action="{{ route('admin.obat.update', $obat) }}" class="max-w-3xl rounded-box border border-base-300 bg-base-100 p-6">
        @csrf
        @method('PUT')
        @include('admin.obat._form', ['submitLabel' => 'Simpan Perubahan'])
    </form>
</x-layouts.app>