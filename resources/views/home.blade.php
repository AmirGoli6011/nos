@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به سایت Nerds Of School خوش اومدی!</h1>
                <p class="lead mb-0">بهترین جا برای تلف کرن وقت</p>
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
                                        توسط
                                        <a class="small text-muted"
                                           href="{{ route('profile',$post->user->username) }}">{{ $post->user->name }}</a>
                                        <a href="{{ route('profile',$post->user->username) }}">
                                            <img src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->name }}"
                                                 style="width: 60px">
                                        </a>
                                        @auth()
                                            @if(auth()->user()->id !== $post->user->id)
                                                @if(auth()->user()->isFollowing($post->user))
                                                    <input type="button" onclick="follow({{ $post->user->id }})"
                                                           class="btn btn-sm" id="follow{{ $post->user->id }}"
                                                           value="دنبال نکردن">
                                                @else
                                                    <input type="button" onclick="follow({{ $post->user->id }})"
                                                           class="btn btn-sm" id="follow{{ $post->user->id }}"
                                                           value="دنبال کردن">
                                                @endif
                                            @endif
                                        @endauth
                                    </div>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <p>
                                        {!! Str::limit(strip_tags($post->body)) !!}
                                    </p>
                                    @auth()
                                        @if(auth()->user()->hasFavorited($post))
                                            <input type="button" onclick="favorite({{ $post->id }})"
                                                   class="btn btn-sm" id="favorite{{ $post->id }}" value="💔">
                                        @else
                                            <input type="button" onclick="favorite({{ $post->id }})"
                                                   class="btn btn-sm" id="favorite{{ $post->id }}" value="❤️">
                                        @endif
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
    @auth()
        <script>
            function follow(user_id) {
                $.post(
                    '{{ route('follow') }}',
                    {
                        follower: {{ auth()->user()->id }},
                        followable: user_id,
                    },
                )
                if ($('#follow' + user_id).val() === 'دنبال نکردن') {
                    $('input#follow' + user_id).val('دنبال کردن')
                } else {
                    $('input#follow' + user_id).val('دنبال نکردن')
                }
            }

            function favorite(post_id) {
                $.post(
                    '{{ route('favorite') }}',
                    {
                        user_id: {{ auth()->user()->id }},
                        post_id: post_id,
                    },
                )
                if ($('#favorite' + post_id).val() === '💔') {
                    $('#favorite' + post_id).val('❤️')
                } else {
                    $('#favorite' + post_id).val('💔')
                }
            }
        </script>
    @endauth
@endsection
