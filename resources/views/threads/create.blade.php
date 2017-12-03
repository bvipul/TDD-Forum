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
                            <label class="control-label" for="title">Title</label>
                            <input name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body" class="control-label">Body</label>
                            <textarea name="body" id="body" class="form-control" rows="9"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm pull-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
