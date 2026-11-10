<x-layouts.guest title="Login">
    <div class="card w-full max-w-105 rounded-2xl bg-base-100 shadow-2xl">
        <div class="card-body my-2 p-6 sm:p-10">
            <div class="mb-8 text-center">
                @if (file_exists(public_path('images/logo-bengkot.png')))
                    <img src="{{ asset('images/logo-bengkot.png') }}" alt="Logo Bengkod" class="mx-auto mb-3.5 size-15 rounded-2xl object-cover">
                @else
                    <span class="mx-auto mb-3.5 flex size-15 items-center justify-center rounded-2xl bg-primary text-2xl font-bold text-primary-content">P</span>
                @endif

                <h1 class="m-0 mb-1.5 text-2xl font-extrabold text-[#1e2d6b]">Poliklinik</h1>
                <p class="m-0 text-xs text-slate-400">Masuk ke akun Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-5 rounded-xl text-sm" role="status">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error mb-5 rounded-xl text-sm" role="alert">
                    <i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf

                <div class="form-control mb-4">
                    <label class="label pb-1" for="email">
                        <span class="text-xs font-semibold text-gray-700">Email</span>
                    </label>
                    <div class="input input-bordered flex w-full items-center gap-3 rounded-xl border-slate-200 bg-slate-50 @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Masukkan email..." class="grow bg-transparent text-sm text-slate-800" required>
                    </div>
                    @error('email')
                        <span class="mt-1 text-xs text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label pb-1" for="password_login">
                        <span class="text-xs font-semibold text-gray-700">Password</span>
                    </label>
                    <div class="input input-bordered flex w-full items-center gap-3 rounded-xl border-slate-200 bg-slate-50 @error('password') input-error @enderror">
                        <i class="fa-solid fa-lock text-xs text-slate-400" aria-hidden="true"></i>
                        <input id="password_login" type="password" name="password" autocomplete="current-password" placeholder="Masukkan password..." class="grow bg-transparent text-sm text-slate-800" required>
                        <button type="button" class="btn btn-ghost btn-xs" id="toggle_login" aria-label="Tampilkan password" onclick="togglePassword('password_login', 'toggle_login')">
                            <i class="fa-solid fa-eye text-xs text-slate-400" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="mt-1 text-xs text-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary-gradient mt-6">
                    <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
                    Login
                </button>
            </form>

            <p class="mt-5 text-center text-xs text-slate-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-[#2d4499] no-underline">Register</a>
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