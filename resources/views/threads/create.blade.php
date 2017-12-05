@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create A Thread</div>

                <div class="panel-body">
                    <form action="{{ route('threads.store') }}" method="POST">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label class="control-label" for="channel_id">Choose a Channel</label>
                            
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value=''>Choose One...</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Title</label>
                            <input name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="body" class="control-label">Body</label>
                            <textarea name="body" id="body" class="form-control" rows="9" required>{{ old('body') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        
                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
