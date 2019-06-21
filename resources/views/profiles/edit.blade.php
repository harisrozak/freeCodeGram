@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="title" class="text-left">{{ __('Title') }}</label>

                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ?? $user->profile->title }}" autocomplete="title" autofocus>

                            @error('title')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-left">{{ __('Description') }}</label>

                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description" autofocus>

                            @error('description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url" class="text-left">{{ __('URL') }}</label>

                            <input id="url" type="text" class="form-control" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url" autofocus>

                            @error('url')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-left">{{ __('Profile Image') }}</label>

                            <input id="image" type="file" class="form-control-file" name="image" value="{{ old('image') }}">

                            @error('image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="text-right pt-3">
                            <button class="btn btn-primary">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
