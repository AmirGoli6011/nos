<div>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-header">
                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" width="200px">
                    </div>
                    <!-- User Profile-->
                    <div class="card-body">
                        <h3>{{ $user->name }}</h3>
                        @if(auth()->user()->id !== $user->id)
                            @if(auth()->user()->isFollowing($user))
                                <button class="btn" wire:click="follow({{ auth()->user()->id }},{{ $user->id }})">
                                    دنبال نکردن
                                </button>
                            @else
                                <button class="btn" wire:click="follow({{ auth()->user()->id }},{{ $user->id }})">
                                    دنبال کردن
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row text-center">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال کننده ها: {{ $user->followers()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach($user->followers as $follower)
                                    <a href="{{ route('profile',$follower->username) }}">
                                        <img src="{{ asset($follower->avatar) }}" alt="{{ $follower->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $follower->name }}</h5>
                                    </a>
                                    @if(auth()->user()->id !== $follower->id)
                                        @if(auth()->user()->isFollowing($follower))
                                            <button class="btn"
                                                    wire:click="follow({{ auth()->id() }},{{ $follower->id }})">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button class="btn"
                                                    wire:click="follow({{ auth()->id() }},{{ $follower->id }})">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    @endif
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال شونده ها: {{ $user->followings()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach($user->followings as $followings)
                                    <a href="{{ route('profile',$followings->username) }}">
                                        <img src="{{ asset($followings->avatar) }}" alt="{{ $followings->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $followings->name }}</h5>
                                    </a>
                                    @if(auth()->user()->id !== $followings->id)
                                        @if(auth()->user()->isFollowing($followings))
                                            <button class="btn"
                                                    wire:click="follow({{ auth()->id() }},{{ $followings->id }})">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button class="btn"
                                                    wire:click="follow({{ auth()->id() }},{{ $followings->id }})">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    @endif
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
