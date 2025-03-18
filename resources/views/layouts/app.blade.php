<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Tasaciones San Juan Gobierno')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    @if (!request()->routeIs('login'))
        @include('layouts.navigation')
    @endif
        <!-- Page Heading -->
        @isset($header)
            <header>
                <div>
                    {{ $header }}
                </div>
            </header>
        @endisset
    <div class="main-content" id="mainContent"> {{-- Contenedor del contenido principal --}}

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="text-center mt-4 py-3" style="background-color: #f8f9fa; border-top: 1px solid #ddd;">
        <p class="mb-0">
            Desarrollado con ❤️ por
            <a href="https://www.managerdoc.com.ar/" target="_blank" class="text-primary fw-bold" style="text-decoration: none;">
                ManagerDoc
            </a>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
