@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-header">
                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" width="200px">
                    </div>
                    <div class="card-body">
                        <h3>{{ $user->name }}</h3>
                        @auth()
                            @if(auth()->user()->id !== $user->id)
                                @if(auth()->user()->isFollowing($user))
                                    <input type="button" class="btn btn-sm" id="follow" value="دنبال نکردن">
                                @else
                                    <input type="button" class="btn btn-sm" id="follow" value="دنبال کردن">
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row text-center">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال کننده ها: {{ auth()->user()->followers()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach(auth()->user()->followers as $follower)
                                    <a href="{{ route('profile',$follower->username) }}">
                                        <img src="{{ asset($follower->avatar) }}" alt="{{ $follower->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $follower->name }}</h5>
                                    </a>
                                    <form action="{{ route('follow.web') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="follower" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="followable" value="{{ $follower->id }}">
                                        @if(auth()->user()->isFollowing($follower))
                                            <button type="submit" class="btn">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button type="submit" class="btn">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>دنبال شونده ها: {{ auth()->user()->followings()->count() }}</h5>
                            </div>
                            <div class="card-body">
                                @foreach(auth()->user()->followings as $followings)
                                    <a href="{{ route('profile',$followings->username) }}">
                                        <img src="{{ asset($followings->avatar) }}" alt="{{ $followings->name }}"
                                             style="width: 100px;">
                                        <h5>{{ $followings->name }}</h5>
                                    </a>
                                    <form action="{{ route('follow') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="follower" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="followable" value="{{ $followings->id }}">
                                        @if(auth()->user()->isFollowing($followings))
                                            <button type="submit" class="btn">
                                                دنبال نکردن
                                            </button>
                                        @else
                                            <button type="submit" class="btn">
                                                دنبال کردن
                                            </button>
                                        @endif
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#follow').click(function () {
            $.post(
                '{{ route('follow') }}',
                {
                    follower: {{ auth()->user()->id }},
                    followable: {{ $user->id }},
                },
            )
            if ($('#follow').val() === 'دنبال کردن') {
                $(this).val('دنبال نکردن')
            } else {
                $(this).val('دنبال کردن')
            }
        })
    </script>
@endsection