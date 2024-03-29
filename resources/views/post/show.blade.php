@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1" id="title">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">
                            نوشته شده در{{ $post->updated_at }}
                            <br>
                            توسط {{ $user->name }}
                        </div>
                        <!-- Post categories-->
                        @foreach($post->tags as $tag)
                            <a class="badge bg-secondary text-decoration-none link-light"
                               href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                        @endforeach
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                                              src="{{ asset($post->image) }}" alt="{{ $post->title }}"/>
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {!! $post->body !!}
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4" action="{{ route('comment.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea id="comment" name="comment" class="form-control" rows="3"
                                          placeholder="Join the discussion and leave a comment!"></textarea>
                                <button type="submit" class="btn btn-success">ارسال</button>
                                <script>
                                    CKEDITOR.replace('comment', {
                                        filebrowserUploadUrl: '{{ route("post.upload",['title'=>$post->title,"_token" => csrf_token()])}}',
                                    })
                                </script>
                            </form>
                            <!-- Single comment-->
                            @foreach($comments as $comment)
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="img-fluid rounded"
                                                                    style="width: 70px"
                                                                    src="{{ asset($comment->user->avatar) }}"
                                                                    alt="{{ $comment->user->name }}"/></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">{{ $comment->user->name }}</div>
                                        {!! $comment->comment !!}
                                    </div>
                                    @auth()
                                        <div class="btn btn-group">
                                            @if($post->user->id === auth()->user()->id or auth()->user()->id === 1 or auth()->user()->id === $comment->user->id)
                                                <form action="{{ route('comment.destroy',$comment->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection