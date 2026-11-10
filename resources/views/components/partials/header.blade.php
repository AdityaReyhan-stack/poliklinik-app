<header class="bg-base-100 border-b border-base-300 h-16 flex items-center px-6 gap-4 sticky top-0 z-30 shadow-sm">
    <button
        type="button"
        onclick="toggleSidebar()"
        class="btn btn-square btn-ghost lg:hidden"
        aria-label="Buka navigasi"
        aria-controls="app-sidebar"
        aria-expanded="false"
    >
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex-1">
        <div class="flex items-center gap-2 text-sm">
            <span class="text-base-content/50">Poliklinik</span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-base-content/30">
                <path d="m9 18 6-6-6-6" />
            </svg>
            <span class="font-semibold text-base-content">{{ $title ?? 'Dashboard' }}</span>
        </div>
    </div>

    <button type="button" onclick="toggleFullscreen()" class="btn btn-square btn-ghost" aria-label="Layar penuh">
        <svg id="fullscreen-expand" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 3H5a2 2 0 0 0-2 2v3m13-5h3a2 2 0 0 1 2 2v3M3 16v3a2 2 0 0 0 2 2h3m13-5v3a2 2 0 0 1-2 2h-3" />
        </svg>
        <svg id="fullscreen-compress" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
            <path d="M8 3v3a2 2 0 0 1-2 2H3m13-5v3a2 2 0 0 0 2 2h3M3 16h3a2 2 0 0 1 2 2v3m13-5h-3a2 2 0 0 0-2 2v3" />
        </svg>
    </button>

    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <div class="text-sm font-semibold leading-tight">{{ auth()->user()?->name ?? 'Pengguna' }}</div>
            <div class="text-xs text-base-content/50 leading-tight">{{ auth()->user()?->role ?? 'Pengguna' }}</div>
        </div>

        <div class="avatar placeholder">
            <div class="w-10 h-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                <span class="text-sm font-semibold leading-none">{{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}</span>
            </div>
        </div>
    </div>
</header>

@once
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const menuButton = document.querySelector('[aria-controls="app-sidebar"]');

            sidebar?.classList.toggle('open');
            overlay?.classList.toggle('open');
            menuButton?.setAttribute('aria-expanded', sidebar?.classList.contains('open') ? 'true' : 'false');
        }

        async function toggleFullscreen() {
            if (!document.fullscreenElement) {
                await document.documentElement.requestFullscreen();
            } else {
                await document.exitFullscreen();
            }
        }

        document.addEventListener('fullscreenchange', () => {
            const expandIcon = document.getElementById('fullscreen-expand');
            const compressIcon = document.getElementById('fullscreen-compress');
            const isFullscreen = Boolean(document.fullscreenElement);

            expandIcon?.classList.toggle('hidden', isFullscreen);
            compressIcon?.classList.toggle('hidden', !isFullscreen);
        });
    </script>
@endonce