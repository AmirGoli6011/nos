@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پست هایی که ساختی خوش اومدی!</h1>
                <p class="lead mb-0">اینجا میتونی پست هایی که ساختی رو ببینی و ویرایش یا حذف کنی</p>
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
                                <a href="{{ route('post.show',$post->slug) }}">
                                    <img class="card-img-top"
                                         src="{{ asset($post->image) }}"
                                         alt="{{ $post->title }}"/>
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        نوشته شده در {{ $post->updated_at }}
                                        توسط {{ $post->user->name }}
                                    </div>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <p>
                                        {!! Str::limit(strip_tags($post->body)) !!}
                                    </p>
                                    <p>
                                        {{ $post->favoriters()->count() }} نفر افزودن به علاقه مندی ها
                                    </p>
                                    <form action="{{ route('post.destroy',$post->slug) }}" method="post">
                                        <a class="btn btn-success"
                                           href="{{ route('post.edit',$post->slug) }}">ویرایش</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
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