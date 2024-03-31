@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پنل ادمین خوش اومدی</h1>
                <p class="lead mb-0">به بخش یوزر ها خوش اومدی</p>
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
                            <th>Users</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tbody>
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="{{ route('profile',$user->username) }}">
                                        <p>
                                            {{ $user->name }}
                                        </p>
                                    </a>
                                    <a href="{{ route('profile',$user->username) }}">
                                        <img class="img-fluid rounded" style="width: 70px"
                                             src="{{ asset($user->avatar) }}" alt="">
                                    </a>
                                    <form action="{{ route('user.destroy',$user->id) }}" method="post">
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