<x-layouts.app title="Tambah Obat">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Tambah Obat</h1>
        <p class="mt-1 text-sm text-base-content/60">Masukkan informasi obat baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.obat.store') }}" class="max-w-3xl rounded-box border border-base-300 bg-base-100 p-6">
        @csrf
        @include('admin.obat._form', ['submitLabel' => 'Simpan'])
    </form>
</x-layouts.app>