<div>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{ route('post.show',$post->slug) }}">
                                    <img class="card-img-top"
                                         src="{{ asset($post->image) }}"
                                         alt="{{ $post->title }}"/>
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        نوشته شده در {{ verta($post->created_at)->formatJalaliDate() }}
                                        توسط
                                        <a class="small text-muted"
                                           href="{{ route('profile',$post->user->username) }}">{{ $post->user->name }}</a>
                                        <a href="{{ route('profile',$post->user->username) }}">
                                            <img class="img-fluid" src="{{ asset($post->user->avatar) }}"
                                                 alt="{{ $post->user->name }}"
                                                 style="width: 60px">
                                        </a>
                                        @auth()
                                            @if(auth()->user()->id !== $post->user->id)
                                                @if(auth()->user()->isFollowing($post->user))
                                                    <input type="button" class="btn btn-sm"
                                                           wire:click="follow({{ $post->user->id }})"
                                                           value="دنبال نکردن">
                                                @else
                                                    <input type="button" class="btn btn-sm"
                                                           wire:click="follow({{ $post->user->id }})"
                                                           value="دنبال کردن">
                                                @endif
                                            @endif
                                        @endauth
                                    </div>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <p class="link-body-emphasis">
                                            {!! Str::limit(strip_tags($post->body)) !!}
                                        </p>
                                    </a>
                                    @auth()
                                        @if(auth()->id() !== $post->user->id)
                                            @if(auth()->user()->hasFavorited($post))
                                                <img src="{{ asset('css/bootstrap-icons/heart-fill.svg') }}" alt="like"
                                                     wire:click="like({{ $post->id }})"
                                                     width="16" height="16">
                                            @else
                                                <img src="{{ asset('css/bootstrap-icons/heart.svg') }}" alt="like"
                                                     wire:click="like({{ $post->id }})"
                                                     width="16" height="16">
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination-->
                <div wire:loading class="loading"></div>
                <script>
                    window.onscroll = function () {
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                            window.livewire.emit('loadMore');
                        }
                    };
                </script>
            </div>
            <!-- Side widgets-->
            <livewire:layouts.sidebar/>
        </div>
    </div>
</div>