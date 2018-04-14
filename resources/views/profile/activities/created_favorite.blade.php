@component('profile.activities.activity')

    @slot("heading")
        {{ $profileUser->name }} favourited a
        <a href="{{ $activity->subject->favorited->path() }}">reply</a>
    @endslot

    @slot("body")
        {{ $activity->subject->favorited->body  }}
    @endslot

@endcomponent