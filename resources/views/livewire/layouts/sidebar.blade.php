<div class="col-lg-4">
    <!-- Side widgets-->
    <div class="relative p-2">
        <!-- Search widget-->
        <div class="card mb-4">
            <div class="card-header">جستجو</div>
            <div class="card-body">
                <div class="input-group">
                    <input wire:model.debounce.1s="search" class="form-control" type="text" name="search"
                           placeholder="جسجتو کن..."
                           aria-label="Enter search term..." aria-describedby="button-search"/>
                </div>
            </div>
        </div>
        <div wire:loading class="w-1/3 bg-white rounded-lg shadow">
            <ul class="divide-y-2 divide-gray-100">
                <li class="p-2 hover:bg-blue-600 hover:text-blue-200">
                    درحال جسجتو...
                </li>
            </ul>
        </div>
        @if(!empty($search))
            <div class="w-1/3 bg-white rounded-lg shadow">
                @if(!empty($posts))
                    <ul class="divide-y-2 divide-gray-100">
                        @foreach($posts as $post)
                            <li class="p-2 hover:bg-blue-600 hover:text-blue-200">
                                <a href="{{ route('post.show',$post->slug) }}" class="padding-top-5 list-item">
                                    {{ $post->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="list-item">چیزی پیدا نشد!</div>
                @endif
            </div>
        @endif
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">تگ ها</div>
            <div class="card-body">
                <div class="row">
                    @foreach(App\Models\Category::all() as $tag)
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ route('category.show',$tag->name) }}">{{ $tag->name }}</a></li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>