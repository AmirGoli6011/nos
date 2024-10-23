@php use App\Models\Category; @endphp
@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post content-->
                <article>
                    <form action="{{ route('category.update',$tag->name) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="name">عنوان: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" id="name" value="{{ $tag->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button class="btn btn-success" type="submit">ساختن</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
@endsection