@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به سایت Nerds Of School خوش اومدی!</h1>
                <p class="lead mb-0">بهترین جا برای تلف کرن وقت است</p>
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
                                <a href="{{ route('post.show',$post->slug) }}"><img class="card-img-top"
                                                                  src="{{ asset($post->image) }}"
                                                                  alt="{{ $post->title }}"/></a>
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
                                    @auth()
                                        <form action="{{ route('favorite.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="post" value="{{ $post->id }}">
                                            @if(auth()->user()->hasFavorited($post))
                                                <button type="submit" class="btn btn-sm" id="favorite">
                                                    💔
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-sm" id="favorite">
                                                    ❤️
                                                </button>
                                            @endif
                                        </form>
                                    @endauth
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