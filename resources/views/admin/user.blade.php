@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1>
                    {{ $user->name }}
                </h1>
                <img class="img-fluid rounded" style="width: 300px"
                     src="{{ asset($user->avatar) }}">
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
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>Comments</th>
                            <th>Posts</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                @foreach($comments as $comment)
                                    {!! $comment->comment !!}
                                    <a href="/{{ $comment->post->slug }}" class="btn btn-success">نمایش پست</a>
                                    <form action="{{ route('comment.destroy',$comment->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($posts as $post)
                                    <p>
                                        {{ $post->title }}
                                    </p>
                                    <a href="{{ route('post.show',$post->slug) }}" class="btn btn-success">نمایش پست</a>
                                    <form action="{{ route('post.destroy',$post->slug) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination-->
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection