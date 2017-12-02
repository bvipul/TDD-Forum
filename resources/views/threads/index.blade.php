@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                                <a href="#">{{ $thread->creator->name }}</a>
                            </div>
                
                            <div class="panel-body">
                                {{ $thread->body }}
                            </div>
                        </div>
                
                    @endforeach
                </div>

            </div>            
        </div>
    </div>
</div>
@endsection
