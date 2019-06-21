@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 pb-2">
            <h1>All Users</h1>  
            <p>Visit these profiles and then click the blue button to follow</p>
        </div>
    </div>

    @foreach($users as $user) 
    <a href="{{ route('profiles.show', $user) }}" class="text-dark text-decoration-none">
        <div class="row justify-content-center mb-3">
            <div class="col-7">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="d-flex">
                            <div style="width: 57px;">
                                <img class="w-100 rounded-circle" src="{{ $user->profile->profileImage() }}">
                            </div>
                            <div class="ml-3">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <div class="d-flex">
                                        <div class="h3 mb-1">{{ $user->username }}</div>
                                    </div>
                                </div>
                                 <div class="d-flex">
                                    <div class="pr-3"><strong>{{ $user->count('posts') }}</strong> posts</div>
                                    <div class="pr-3"><strong>{{ $user->count('followers') }}</strong> followers</div>
                                    <div class="pr-3"><strong>{{ $user->count('following') }}</strong> following</div>
                                </div>                        
                            </div>
                        </div>
                    </div>      
                    <div class="p-3">          
                        <div class="font-weight-bold">{{ $user->profile->title }}</div>
                        <div>{{ $user->profile->description }}</div>
                        <div><a class="font-weight-bold" href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach

    <div class="row justify-content-center">
        <div class="col-7">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
