@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" style="width: 300px;">
                    </div>
                    <div class="card-body">
                        <h3>نام: {{ $user->name }}</h3>
                        <h3>دنبال کننده ها: {{ $user->followers()->count() }}</h3>
                        @if(auth()->user()->id !== $user->id)
                            <form action="{{ route('follow') }}" method="post">
                                @csrf
                                <input type="hidden" name="follower" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="followable" value="{{ $user->id }}">
                                @if(auth()->user()->isFollowing($user))
                                    <button type="submit" class="btn">
                                        دنبال نکردن
                                    </button>
                                @else
                                    <button type="submit" class="btn">
                                        دنبال کردن
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection