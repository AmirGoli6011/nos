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
                                <button class="btn" wire:click="follow({{ $user->id }})">
                                    دنبال نکردن
                                </button>
                            @else
                                <button class="btn" wire:click="follow({{ $user->id }})">
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
                                @foreach($followers as $follower)
                                    <a href="{{ route('profile',$follower->username) }}">
                                        <img src="{{ asset($follower->avatar) }}" alt="{{ $follower->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $follower->name }}</h5>
                                    </a>
                                    @if(auth()->user()->id !== $follower->id)
                                        @if(auth()->user()->isFollowing($follower))
                                            <button class="btn"
                                                    wire:click="follow({{ $follower->id }})">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button class="btn"
                                                    wire:click="follow({{ $follower->id }})">
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
                                @foreach($followings as $following)
                                    <a href="{{ route('profile',$following->username) }}">
                                        <img src="{{ asset($following->avatar) }}" alt="{{ $following->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $following->name }}</h5>
                                    </a>
                                    @if(auth()->user()->id !== $following->id)
                                        @if(auth()->user()->isFollowing($following))
                                            <button class="btn"
                                                    wire:click="follow({{ $following->id }})">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button class="btn"
                                                    wire:click="follow({{ $following->id }})">
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
