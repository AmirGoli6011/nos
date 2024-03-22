<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">جستجو</div>
        <div class="card-body">
            <form action="{{ route('search') }}" method="get">
                <div class="input-group">
                    <input class="form-control" type="text" name="search" placeholder="عبارت جستجو را وارد کنید..."
                           aria-label="Enter search term..." aria-describedby="button-search"/>
                    <button class="btn btn-primary" id="button-search" type="submit">برو!</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                @foreach(App\Models\Tag::all() as $tag)
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('tag',$tag->name) }}">{{ $tag->name }}</a></li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Side widget-->
    {{--<div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and
            feature the Bootstrap 5 card component!
        </div>
    </div>--}}
</div>