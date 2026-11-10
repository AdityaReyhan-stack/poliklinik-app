<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Poliklinik' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="app-wrapper">
        @include('components.partials.sidebar')

        <div class="main-content">
            @include('components.partials.header', ['title' => $title ?? 'Dashboard'])

            <main class="main-scroll">
                @if (session('success'))
                    <div class="alert alert-success mb-4 rounded-xl shadow-sm" role="status">
                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error mb-4 rounded-xl shadow-sm" role="alert">
                        <i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>

            @include('components.partials.footer')
        </div>
    </div>

    @stack('scripts')
</body>

</html>