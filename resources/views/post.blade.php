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
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">نوشته شده در {{ $post->updated_at }}
                            توسط {{ $user->name }}</div>
                        <!-- Post categories-->
                        {{--                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>--}}
                        {{--                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>--}}
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                                              src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}"/>
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {!! $post->body !!}
                        <script>
                            $('img').addClass('img-fluid rounded')
                        </script>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4" action="{{ route('comment.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea id="comment" name="comment" class="form-control" rows="3"
                                          placeholder="Join the discussion and leave a comment!"></textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#comment'), {
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
                                <button type="submit" class="btn btn-success">ارسال</button>
                            </form>
                            <!-- Single comment-->
                            <div class="d-flex">
                                @foreach($comments as $comment)
                                    <div class="flex-shrink-0"><img class="rounded-circle"
                                                                    src="{{ $comment->user->image }}"
                                                                    alt="{{ $comment->user->image }}"/></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">{{ $comment->user->name }}</div>
                                        {!! $comment->comment !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection