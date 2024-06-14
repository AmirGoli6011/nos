@extends('layouts.app')
@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">به پست هایی که ساختی خوش اومدی!</h1>
                <p class="lead mb-0">اینجا میتونی پست هایی که ساختی رو ببینی و ویرایش یا حذف کنی</p>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <livewire:post.index/>
@endsection