@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-1">
                <a class="nav-link" href="{{ route('profile',auth()->user()->username) }}">
                    پروفایل
                </a>
            </div>
            <div class="col-lg-5">
                <div class="row text-center">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال کننده ها: {{ auth()->user()->followers()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach(auth()->user()->followers as $follower)
                                    <a href="{{ route('profile',$follower->username) }}">
                                        <img src="{{ asset($follower->avatar) }}" alt="{{ $follower->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $follower->name }}</h5>
                                    </a>
                                    <form action="{{ route('follow') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="follower" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="followable" value="{{ $follower->id }}">
                                        @if(auth()->user()->isFollowing($follower))
                                            <button type="submit" class="btn">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button type="submit" class="btn">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال شونده ها: {{ auth()->user()->followings()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach(auth()->user()->followings as $followings)
                                    <a href="{{ route('profile',$followings->username) }}">
                                        <img src="{{ asset($followings->avatar) }}" alt="{{ $followings->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $followings->name }}</h5>
                                    </a>
                                    <form action="{{ route('follow') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="follower" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="followable" value="{{ $followings->id }}">
                                        @if(auth()->user()->isFollowing($followings))
                                            <button type="submit" class="btn">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button type="submit" class="btn">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>ویرایش مشخصات</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update',auth()->user()->username) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="avatar"
                                       class="col-md-4 col-form-label text-md-end">اواتار</label>
                                <div class="col-md-6">
                                    <input id="avatar" type="file" class="form-control" name="avatar">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('اسم') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ auth()->user()->name }}" autocomplete="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username"
                                       class="col-md-4 col-form-label text-md-end">{{ __('نام کاربری') }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ auth()->user()->username }}" autocomplete="username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('آدرس ایمیل') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ auth()->user()->email }}" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('رمز') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{ __('تکرار رمز') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ویرایش') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection