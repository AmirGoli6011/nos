@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پست هایی که شما ساختید خوش امدید</h1>
                <p class="lead mb-0">اینجا همه پست هایی که شما ساخته اید را میتوانید ببنید</p>
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
                                <a href="/{{ $post->slug }}"><img class="card-img-top"
                                                                 src="{{ asset($post->image) }}"
                                                                 alt="{{ $post->title }}"/></a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        نوشته شده در {{ $post->updated_at }}
                                        توسط {{ $post->user->name }}
                                    </div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">
                                        {!! $post->body !!}
                                    </p>
                                    <a class="btn btn-primary" href="/{{ $post->slug }}">ادامه مطلب ←</a>
                                    <form action="{{ route('post.destroy',$post->id) }}" method="post">
                                        <a class="btn btn-success"
                                           href="{{ route('post.edit',$post->id) }}">ویرایش</a>
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