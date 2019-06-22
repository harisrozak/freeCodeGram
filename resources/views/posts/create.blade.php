@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Post') }}</div>

                <form action="{{ route('p.store') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="card-body">                    
                        <div class="form-group">
                            <label for="caption" class="text-left">{{ __('Post Caption') }}</label>

                            <input id="caption" type="text" class="form-control" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>

                            @error('caption')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-left">{{ __('Post Image') }}</label>

                            <input id="image" type="file" class="form-control-file" name="image" value="{{ old('image') }}">

                            @error('image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-primary">Save Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
