@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پنل ادمین خوش اومدی</h1>
                <p class="lead mb-0">به بخش کامنت ها خوش اومدی</p>
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
                            <th>ID</th>
                            <th>User</th>
                            <th>Comment</th>
                            <th>Post</th>
                        </tr>
                        </thead>
                        @foreach($comments as $comment)
                            <tbody>
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>
                                    <p>
                                        {{ $comment->user->name }}
                                    </p>
                                    <a href="{{ route('admin.user',$comment->user->name) }}">
                                        <img class="img-fluid rounded" style="width: 70px"
                                             src="{{ asset($comment->user->avatar) }}">
                                    </a>
                                </td>
                                <td>{!! $comment->comment !!}</td>
                                <td>
                                    <p>
                                        {{ $comment->post->title }}
                                    </p>
                                    <a href="/{{ $comment->post->slug }}">
                                        <img class="img-fluid rounded" style="width: 70px"
                                             src="{{ asset($comment->post->image) }}">
                                    </a>
                                    <form action="{{ route('post.destroy',$comment->post->id) }}" method="post">
                                        <a class="btn btn-success"
                                           href="{{ route('post.edit',$comment->post->id) }}">ویرایش</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- Pagination-->
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection