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
                            <th>Tags</th>
                        </tr>
                        </thead>
                        @foreach($tags as $tag)
                            <tbody>
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>
                                    <p>
                                        {{ $tag->name }}
                                    </p>
                                    <form action="{{ route('tag.destroy',$tag->name) }}" method="post">
                                        <a class="btn btn-success"
                                           href="{{ route('tag.edit',$tag->name) }}">ویرایش</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </td>
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