@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پنل ادمین خوش اومدی</h1>
                <p class="lead mb-0">به بخش پست ها خوش اومدی</p>
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
                            <th>Post</th>
                        </tr>
                        </thead>
                        @foreach($posts as $post)
                            <tbody>
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <a href="{{ route('admin.user',$post->user->username) }}">
                                        <p>
                                            {{ $post->user->name }}
                                        </p>
                                        <img class="img-fluid rounded" style="width: 70px"
                                             src="{{ asset($post->user->avatar) }}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <p>
                                            {{ $post->title }}
                                        </p>
                                        <img class="img-fluid rounded" style="width: 70px"
                                             src="{{ asset($post->image) }}" alt="">
                                    </a>
                                    <form action="{{ route('post.destroy',$post->slug) }}" method="post">
                                        <a class="btn btn-success"
                                           href="{{ route('post.edit',$post->slug) }}">ویرایش</a>
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
            <livewire:sidebar/>
        </div>
    </div>
@endsection