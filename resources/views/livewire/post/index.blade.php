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
                                        نوشته شده در {{ verta($post->created_at)->formatJalaliDatetime() }}
                                    </div>
                                    <a href="{{ route('post.show',$post->slug) }}">
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                    </a>
                                    <p>
                                        {!! Str::limit(strip_tags($post->body)) !!}
                                    </p>
                                    <p>
                                        @if($post->favoriters()->count() === 1)
                                            {{ $post->favoriters()->count() }} نفر اضافه کرده به علاقه مندی هاش
                                        @elseif($post->favoriters()->count() === 0)
                                            هیچکس اضافه نکرده به علاقه مندی هاش
                                        @else
                                            {{ $post->favoriters()->count() }} نفر اضافه کردن به علاقه مندی هاشون
                                        @endif
                                    </p>
                                    <a class="btn btn-success"
                                       href="{{ route('post.edit',$post->slug) }}">
                                        ویرایش</a>
                                    <button class="btn btn-danger" wire:click="delete({{ $post->id }})">حذف</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination-->
{{--                {{ $posts->links('pagination::bootstrap-4') }}--}}
            </div>
            <livewire:sidebar/>
        </div>
    </div>
</div>
