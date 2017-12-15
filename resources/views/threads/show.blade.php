@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $thread->title }}
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
            
            @if($replies->count() > 0)
                <!-- For Replies -->
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        Replies
                    </div>
                    
                    <div class="panel panel-body">
                        @foreach($replies as $reply)
                            @include('threads.reply')
                        @endforeach

                        {{ $replies->links() }}
                    </div>
                </div>
            @endif

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

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    This thread was published {{ $thread->created_at->diffForHumans() }} by 
                    <a href="{{ route('profile', $thread->creator)  }}"> {{ $thread->creator->name }} </a>
                    and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
