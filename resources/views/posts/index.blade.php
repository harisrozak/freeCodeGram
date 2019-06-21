@extends('layouts.app')

@section('content')
<div class="container">
   @foreach($posts as $post)

    <div class="row justify-content-center mb-3">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="align-items-center">
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="d-flex text-dark align-items-center">
                            <div style="width: 40px;">
                                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100">
                            </div>
                            <div class="ml-3">
                                <strong>{{ $post->user->username }}</strong>                            
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-7">
                        <img class="w-100" src="/storage/{{ $post->image }}">
                    </div>
                    <div class="col-5">
                        <p>{{ $post->caption }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <div class="row justify-content-center">
        <div class="col-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
