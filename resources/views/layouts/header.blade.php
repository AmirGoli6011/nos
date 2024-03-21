<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Nerd Of School</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Nerds Of School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">خانه</a></li>
                @auth()
                    <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}">ساخت پست</a></li>
                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('post.index') }}">{{ auth()->user()->name }}</a></li>
                    <li class="nav-item"><img class="img-fluid rounded"
                                              style="width: 70px"
                                              src="{{ 'storage/'.auth()->user()->avatar }}"></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">خروج</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">ثبت نام</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ورود</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@yield('header')