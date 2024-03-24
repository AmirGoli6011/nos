@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به لیست علاقه مندی ها خوش اومدی!</h1>
                <p class="lead mb-0">اینجا میتونی پست هایی که به علاقه مندی اضافه کردی رو ببینی</p>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{ $post->slug }}"><img class="card-img-top"
                                                                 src="{{ asset($post->image) }}"
                                                                 alt="{{ $post->title }}"/></a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        نوشته شده در {{ $post->updated_at }}
                                        توسط {{ $post->user->name }}
                                    </div>
                                    <a href="{{ $post->slug }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <form action="{{ route('favorite.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="post" value="{{ $post->id }}">
                                        <button type="submit" class="btn btn-sm" id="favorite">
                                            💔
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination-->
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection