@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1>
					{{ $profileUser->name }}
					<small>since {{ $profileUser->created_at->diffForHumans() }}</small>
				</h1>
			</div>

			@foreach($threads as $thread)
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="level">
						<h3 class="flex">
							<a href="{{ $thread->path() }}">{{ $thread->title }}</a>
						</h3>
						{{ $thread->created_at->diffForHumans()}}
					</div>
				</div>

				<div class="panel-body">
					{{ $thread->body }}
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection