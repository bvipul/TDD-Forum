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
</div>
@endsection
