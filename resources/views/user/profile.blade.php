@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8 text-center">
                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" style="width: 300px;">
                <h3>نام: {{ $user->name }}</h3>
                <h3>دنبال کننده ها: {{ $user->followers()->count() }}</h3>
            </div>
            <!-- Pagination-->
            @include('layouts.sidebar')
        </div>
    </div>
@endsection