<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <label class="form-control">
        <span class="label"><span class="label-text font-medium">Nama Obat</span></span>
        <input name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" class="input input-bordered w-full @error('nama_obat') input-error @enderror" required maxlength="255">
        @error('nama_obat')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
    </label>

    <label class="form-control">
        <span class="label"><span class="label-text font-medium">Jenis Obat</span></span>
        <input name="jenis_obat" value="{{ old('jenis_obat', $obat->jenis_obat) }}" class="input input-bordered w-full @error('jenis_obat') input-error @enderror" required maxlength="255">
        @error('jenis_obat')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
    </label>

    <label class="form-control">
        <span class="label"><span class="label-text font-medium">Kemasan</span></span>
        <input name="kemasan" value="{{ old('kemasan', $obat->kemasan) }}" placeholder="Contoh: strip 10 tablet" class="input input-bordered w-full @error('kemasan') input-error @enderror" required maxlength="100">
        @error('kemasan')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
    </label>

    <label class="form-control">
        <span class="label"><span class="label-text font-medium">Stok</span></span>
        <input type="number" name="stok" value="{{ old('stok', $obat->stok ?? 0) }}" min="0" step="1" class="input input-bordered w-full @error('stok') input-error @enderror" required>
        @error('stok')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
    </label>

    <label class="form-control sm:col-span-2">
        <span class="label"><span class="label-text font-medium">Harga (Rp)</span></span>
        <input type="number" name="harga" value="{{ old('harga', $obat->harga) }}" min="0" step="0.01" class="input input-bordered w-full @error('harga') input-error @enderror" required>
        @error('harga')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
    </label>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.obat.index') }}" class="btn btn-ghost">Batal</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>