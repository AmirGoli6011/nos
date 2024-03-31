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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <link href="{{ asset('js/ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css') }}"
          rel="stylesheet"/>
    <script src="{{ asset('js/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
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
                @auth()
                    @if(auth()->user()->id === 1)
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('admin.posts') }}">
                                پست ها
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('admin.users') }}">
                                یوزر ها
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('admin.comments') }}">
                                کامنت ها
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('tag.index') }}">
                                تگ ها
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tag.create') }}">
                                ساخت تگ
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}">
                            ساخت پست
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('favorite.index') }}">
                            علاقه مندی ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('post.index') }}">
                            پست ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="{{ route('dashboard') }}">
                            {{ auth()->user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid rounded"
                                 style="width: 70px"
                                 src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="nav-link"  type="submit">
                                خروج
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">ثبت نام</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ورود</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@yield('header')