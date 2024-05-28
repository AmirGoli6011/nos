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
    <livewire:home/>
@endsection
