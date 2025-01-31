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
</body>

</html>
