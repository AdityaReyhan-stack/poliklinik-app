<x-layouts.guest title="Register">
    <div class="card w-full max-w-120 rounded-2xl bg-base-100 shadow-2xl">
        <div class="card-body p-6 sm:p-10">
            <div class="mb-7 text-center">
                @if (file_exists(public_path('images/logo-bengkot.png')))
                    <img src="{{ asset('images/logo-bengkot.png') }}" alt="Logo Bengkod" class="mx-auto mb-3.5 size-15 rounded-2xl object-cover">
                @else
                    <span class="mx-auto mb-3.5 flex size-15 items-center justify-center rounded-2xl bg-primary text-2xl font-bold text-primary-content">P</span>
                @endif
                <h1 class="m-0 mb-1.5 text-2xl font-extrabold text-[#1e2d6b]">Poliklinik</h1>
                <p class="m-0 text-xs text-slate-400">Buat akun baru</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error mb-4 rounded-xl text-sm" role="alert">
                    <i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-control mb-4">
                    <label class="label pb-1" for="nama"><span class="text-xs font-semibold text-gray-700">Nama Lengkap</span></label>
                    <div class="input input-bordered flex w-full items-center gap-3 rounded-xl border-slate-200 bg-slate-50 @error('nama') input-error @enderror">
                        <i class="fa-solid fa-user text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="nama" type="text" name="nama" value="{{ old('nama') }}" autocomplete="name" placeholder="Masukkan nama lengkap..." class="grow bg-transparent text-sm text-slate-800" required>
                    </div>
                    @error('nama')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label pb-1" for="email"><span class="text-xs font-semibold text-gray-700">Email</span></label>
                    <div class="input input-bordered flex w-full items-center gap-3 rounded-xl border-slate-200 bg-slate-50 @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Masukkan email..." class="grow bg-transparent text-sm text-slate-800" required>
                    </div>
                    @error('email')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label pb-1" for="alamat"><span class="text-xs font-semibold text-gray-700">Alamat</span></label>
                    <div class="input input-bordered flex w-full items-center gap-3 rounded-xl border-slate-200 bg-slate-50 @error('alamat') input-error @enderror">
                        <i class="fa-solid fa-location-dot text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" autocomplete="street-address" placeholder="Masukkan alamat..." class="grow bg-transparent text-sm text-slate-800" required>
                    </div>
                    @error('alamat')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                </div>

                <div class="mb-4 grid grid-cols-1 gap-3.5 sm:grid-cols-2">
                    <div class="form-control">
                        <label class="label pb-1" for="no_hp"><span class="text-xs font-semibold text-gray-700">No. HP</span></label>
                        <div class="input input-bordered flex w-full items-center gap-2 rounded-xl border-slate-200 bg-slate-50 @error('no_hp') input-error @enderror">
                            <i class="fa-solid fa-phone text-xs text-slate-400" aria-hidden="true"></i>
                            <input id="no_hp" type="tel" name="no_hp" value="{{ old('no_hp') }}" autocomplete="tel" placeholder="No. HP..." class="grow bg-transparent text-sm text-slate-800" required>
                        </div>
                        @error('no_hp')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1" for="no_ktp"><span class="text-xs font-semibold text-gray-700">No. KTP</span></label>
                        <div class="input input-bordered flex w-full items-center gap-2 rounded-xl border-slate-200 bg-slate-50 @error('no_ktp') input-error @enderror">
                            <i class="fa-solid fa-address-card text-xs text-slate-400" aria-hidden="true"></i>
                            <input id="no_ktp" type="text" name="no_ktp" value="{{ old('no_ktp') }}" inputmode="numeric" placeholder="No. KTP..." class="grow bg-transparent text-sm text-slate-800" required>
                        </div>
                        @error('no_ktp')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-1 gap-3.5 sm:grid-cols-2">
                    <div class="form-control">
                        <label class="label pb-1" for="jenis_kelamin"><span class="text-xs font-semibold text-gray-700">Jenis Kelamin</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="select select-bordered w-full rounded-xl border-slate-200 bg-slate-50 @error('jenis_kelamin') select-error @enderror" required>
                            <option value="" disabled @selected(old('jenis_kelamin') === null)>Pilih jenis kelamin</option>
                            <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                            <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1" for="tanggal_lahir"><span class="text-xs font-semibold text-gray-700">Tanggal Lahir</span></label>
                        <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ now()->toDateString() }}" class="input input-bordered w-full rounded-xl border-slate-200 bg-slate-50 @error('tanggal_lahir') input-error @enderror" required>
                        @error('tanggal_lahir')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-control mb-4">
                    <label class="label pb-1" for="password_reg"><span class="text-xs font-semibold text-gray-700">Password</span></label>
                    <div class="input input-bordered flex w-full items-center gap-2 rounded-xl border-slate-200 bg-slate-50 @error('password') input-error @enderror">
                        <i class="fa-solid fa-lock text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="password_reg" type="password" name="password" autocomplete="new-password" placeholder="Password..." class="grow bg-transparent text-sm text-slate-800" required minlength="6">
                        <button type="button" class="btn btn-ghost btn-xs" id="toggle_reg" aria-label="Tampilkan password" onclick="togglePassword('password_reg', 'toggle_reg')">
                            <i class="fa-solid fa-eye text-xs text-slate-400" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')<span class="mt-1 text-xs text-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label pb-1" for="password_confirm"><span class="text-xs font-semibold text-gray-700">Konfirmasi Password</span></label>
                    <div class="input input-bordered flex w-full items-center gap-2 rounded-xl border-slate-200 bg-slate-50">
                        <i class="fa-solid fa-lock text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="password_confirm" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Ulangi password..." class="grow bg-transparent text-sm text-slate-800" required minlength="6">
                        <button type="button" class="btn btn-ghost btn-xs" id="toggle_confirm" aria-label="Tampilkan konfirmasi password" onclick="togglePassword('password_confirm', 'toggle_confirm')">
                            <i class="fa-solid fa-eye text-xs text-slate-400" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary-gradient">
                    <i class="fa-solid fa-user-plus" aria-hidden="true"></i>
                    Register
                </button>
            </form>

            <p class="mt-5 text-center text-xs text-slate-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-[#2d4499] no-underline">Login</a>
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            function togglePassword(inputId, buttonId) {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);
                const icon = button?.querySelector('i');

                if (!input || !button || !icon) return;

                const showPassword = input.type === 'password';
                input.type = showPassword ? 'text' : 'password';
                icon.classList.toggle('fa-eye', !showPassword);
                icon.classList.toggle('fa-eye-slash', showPassword);
                button.setAttribute('aria-label', showPassword ? 'Sembunyikan password' : 'Tampilkan password');
            }
        </script>
    @endpush
</x-layouts.guest>