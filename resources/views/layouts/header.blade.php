<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            Nerds Of School
        </a>
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
                    <div class="dropdown">
                        <a href="" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-fluid rounded"
                                 style="width: 70px"
                                 src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                        </a>
                        <ul class="dropdown-menu text-center">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    داشبورد
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile',auth()->user()->username) }}">
                                    پروفایل
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit">
                                            خروج
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">ثبت نام</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ورود</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@yield('header')