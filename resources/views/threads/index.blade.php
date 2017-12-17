@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		@if($threads->count() > 0)
		<div class="col-md-8 col-md-offset-2">
			@forelse($threads as $thread)
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="level">
						<h4 class="flex">
							<a href="{{ $thread->path() }}">{{ $thread->title }}</a>
						</h4>

						<strong>
							<a href="{{ $thread->path() }}">
								{{ $thread->replies_count . ' ' . str_plural('reply', $thread->replies_count) }}
							</a>
						</strong>
					</div>
				</div>

				<div class="panel-body">
					{{ $thread->body }}
				</div>

			</div>
			@empty
			<span>There are no relevant threads.</span>
			@endforelse
		</div>
		@else
		<p class="text-center">No Forum Threads are active. Add
			<a href="{{ route('threads.create') }}">Thread</a>
		</p>
		@endif
	</div>
</div>
@endsection