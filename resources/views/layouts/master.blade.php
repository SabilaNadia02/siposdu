{{-- <!DOCTYPE html>
<html>

<head>
    @include('layouts.header')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('layouts.header')
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html> --}}

<!DOCTYPE html>
<html>

<head>
    @include('layouts.header')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('layouts.header')
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Tempatkan yield scripts di bagian bawah sebelum penutup body -->
    @stack('scripts')
    @yield('scripts')
</body>

</html>
