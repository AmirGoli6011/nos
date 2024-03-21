@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post content-->
                <article>
                    <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="image">Image: </label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="title">Title: </label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="title">Body: </label>
                            <textarea class="form-control" name="body" id="body" rows="10">{{ $post->body }}</textarea>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
@endsection