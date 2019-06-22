@extends('layouts.app')

@section('content')
<div class="container">
    @if(count($posts) == 0)

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info" role="alert">
                There is currently no post for you. Check <a href="{{ route('profiles.index') }}">all user profiles</a> to follow a new one.
            </div>
        </div>
    </div>

    @else

    @foreach($posts as $post)

    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="align-items-center">
                        <a href="{{ route('profiles.show', $post->user->username) }}" class="d-flex text-dark align-items-center text-decoration-none">
                            <div style="width: 44px;">
                                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100">
                            </div>
                            <div class="ml-3 mr-2">
                                <strong>{{ $post->user->username }}</strong>
                                <div class="text-muted d-sm-none">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                            <span class="d-none d-sm-block">
                                •
                                <span class="pl-1">{{ $post->created_at->diffForHumans() }}</span>
                            </span>                            
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-sm-7">
                        <img class="w-100" src="/storage/{{ $post->image }}">
                    </div>
                    <div class="col-sm-5 pt-sm-0 pt-3">{{ $post->caption }}</div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
