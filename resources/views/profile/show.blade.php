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

			@foreach($activities as $date => $activity)
				<div class="page-header">
					<h4>{{ $date }}</h4>
				</div>
				
				@foreach($activity as $record)
					@include("profile.activities.{$record->type}", ['activity' => $record])
				@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection