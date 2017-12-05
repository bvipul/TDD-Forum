@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($threads->count() > 0)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Forum Threads
                </div>
                
                <div class="panel-body">
                    @foreach($threads as $thread)
                
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                &nbsp;by&nbsp;
                                <a href="{{ route('threads.index', ['by' => $thread->creator->name])  }}">{{ $thread->creator->name }}</a>
                            </div>
                
                            <div class="panel-body">
                                {{ $thread->body }}
                            </div>
                        </div>
                
                    @endforeach
                </div>

            </div>            
        </div>
        @else
        <p class="text-center">No Forum Threads are active. Add 
            <a href="{{ route('threads.create') }}">Thread</a>
        </p>
        @endif
    </div>
</div>
@endsection
