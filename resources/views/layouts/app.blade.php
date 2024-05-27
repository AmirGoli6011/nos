<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Nerds Of School</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    @livewireStyles
</head>
<body>
@include('layouts.header')
@yield('content')
{{ $slot }}
@include('layouts.footer')
<!-- Core theme JS-->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@livewireScripts
</body>
</html>