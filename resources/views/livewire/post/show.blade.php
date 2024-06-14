<div>
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
                            نوشته شده در{{ verta($post->created_at)->format('%d %B %y h:i') }}
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
                            <textarea id="comment" wire:model="comment" class="form-control"
                                      rows="3" placeholder="به بحث بپیوندید و نظر بدهید!"></textarea>
                            <button class="btn btn-success" wire:click="comment">ارسال</button>
                            {{--<script>
                                tinymce.init({
                                    selector: '#comment',
                                    language: 'fa',
                                    browser_spellcheck: true,
                                    statusbar: false,
                                    menubar: '',
                                    toolbar: 'undo redo bold italic link codesample hr preview help',
                                    plugins: 'link codesample hr preview help',
                                });
                            </script>--}}
                            <!-- Single comment-->
                            @foreach($comments as $comment)
                                <p>
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img class="img-fluid rounded"
                                             style="width: 70px"
                                             src="{{ asset($comment->user->avatar) }}"
                                             alt="{{ $comment->user->name }}"/>
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold">{{ $comment->user->name }}</div>
                                        {{ $comment->comment }}
                                        {{--{!! $comment->comment !!}--}}
                                    </div>
                                    @auth()
                                        <div class="btn btn-group">
                                            @if($post->user->id === auth()->user()->id or auth()->user()->id === 1 or auth()->user()->id === $comment->user->id)
                                                <button wire:click="delete({{ $comment->id }})" class="btn btn-danger">
                                                    حذف
                                                </button>
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <livewire:layouts.sidebar/>
        </div>
    </div>
</div>
