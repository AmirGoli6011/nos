<!-- Side widgets-->
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">جستجو</div>
        <div class="card-body">
{{--            <form action="{{ route('search') }}" method="get">--}}
                <div class="input-group">
                    <input class="form-control" type="text" name="search" placeholder="عبارت جستجو را وارد کنید..."
                           aria-label="Enter search term..." aria-describedby="button-search"/>
                    <button class="btn btn-primary" id="button-search" type="submit">برو!</button>
                </div>
{{--            </form>--}}
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">تگ ها</div>
        <div class="card-body">
            <div class="row">
                @foreach(App\Models\Tag::all() as $tag)
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a></li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>