@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8 text-center">
                <h3>فالوور ها: </h3>
                @foreach(auth()->user()->followers as $follower)
                    <img src="{{ asset($follower->avatar) }}" alt="{{ $follower->name }}" style="width: 100px;">
                    <h3>{{ $follower->name }}</h3>
                @endforeach
            </div>
            <!-- Pagination-->
            @include('layouts.sidebar')
        </div>
    </div>
@endsection