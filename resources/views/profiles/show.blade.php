@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 p-md-5 px-5">
            <img class="w-100 rounded-circle" src="{{ $user->profile->profileImage() }}">
        </div>
        <div class="col-md-9 pt-md-5 pt-4">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex">
                    <h1>{{ $user->username }}</h1>

                    @if(! auth()->user() || (auth()->user() && auth()->user()->id != $user->id))
                    <follow-button user-id="{{ $user->username }}" follows="{{ $follows }}"></follow-button>
                    @endif
                </div>
            </div>
            <div class="d-flex">
                <div class="pr-3"><strong>{{ $user->count('posts') }}</strong> posts</div>
                <div class="pr-3"><strong>{{ $user->count('followers') }}</strong> followers</div>
                <div class="pr-3"><strong>{{ $user->count('following') }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a class="font-weight-bold" href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>
        </div>
    </div>

    <div class="row pt-4">
        @foreach($user->posts as $post)
        <div class="col-sm-4 pb-4">
            <a href="{{ route('p.show', $post->id) }}">
                <img class="w-100" src="/storage/{{ $post->image }}">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
