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
                                <a href="{{ route('post.show',$post->slug) }}"><img class="card-img-top"
                                                                                    src="{{ asset($post->image) }}"
                                                                                    alt="{{ $post->title }}"/></a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        نوشته شده در {{ verta($post->created_at)->formatJalaliDate() }}
                                        توسط {{ $post->user->name }}
                                    </div>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <p>
                                        {!! Str::limit(strip_tags($post->body)) !!}
                                    </p>
                                    <button type="submit" onclick="favorite({{ $post->id }})" class="btn btn-sm"
                                            id="favorite{{ $post->id }}">
                                        💔
                                    </button>
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
    <script>
        function favorite(post_id) {
            $.post(
                '{{ route('favorite') }}',
                {
                    user_id: {{ auth()->user()->id }},
                    post_id: post_id,
                },
            )
            $('#favorite' + post_id).parent().parent().parent().remove()
        }
    </script>
@endsection