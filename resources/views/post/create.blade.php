@php use App\Models\Tag; @endphp
@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post content-->
                <article>
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="tags">تگ ها: </label>
                            <select class="form-control" name="tags[]" multiple>
                                @foreach(Tag::all() as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="image">تصویر: </label>
                            <input type="file" class="form-control"
                                   name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="title">عنوان: </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" id="title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="title">بدنه: </label>
                            <textarea class="form-control @error('body') is-invalid @enderror"
                                      name="body" id="body" rows="10"></textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#body'), {
                                        ckfinder: {
                                            uploadUrl: '{{route('post.upload').'?_token='.csrf_token()}}'
                                        },
                                        language: {
                                            content: 'ar'
                                        }
                                    })
                                    .then(editor => {
                                        console.log(editor);
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    })
                            </script>
                        </div>
                        <button class="btn btn-success" type="submit">ساختن</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
@endsection