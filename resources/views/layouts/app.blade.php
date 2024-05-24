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
    @livewireStyles
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
{{--    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>--}}
{{--    <link href="{{ asset('js/ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css') }}"--}}
{{--          rel="stylesheet"/>--}}
{{--    <script src="{{ asset('js/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>--}}
{{--    <script>hljs.initHighlightingOnLoad();</script>--}}
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
@include('layouts.header')
@yield('content')
{{ $slot }}
@livewireScripts
@include('layouts.footer')
<!-- Bootstrap core JS-->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>--}}
<!-- Core theme JS-->
{{--<script src="{{ asset('js/scripts.js') }}"></script>--}}
</body>
</html>