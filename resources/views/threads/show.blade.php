@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $thread->title }} by 
                    <a href="#">
                        {{ $thread->creator->name }}
                    </a>
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>
    @if($thread->replies->count() > 0)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- For Replies -->
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    Replies
                </div>
                
                <div class="panel panel-body">
                    @foreach($thread->replies as $reply)
                        @include('threads.reply')
                    @endforeach
                </div>
            </div> 
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(auth()->user())
            <form action="{{ $thread->path() . '/replies' }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>
                </div>
                <button type="submit" class="btn btn-info btn-sm pull-right">Reply</button>
            </form>
            @else
            <p>Please <a href="{{ route('login') }}">Sign In</a> to participate in this thread.</p>
            @endif
        </div>
    </div>
</div>
@endsection
