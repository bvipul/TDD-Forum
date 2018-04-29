<div id="{{ 'reply-'. $reply->id }}" class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a>
                said {{ $reply->created_at->diffForHumans() }}
            </h5>

            <form method="POST" action="{{ route('reply.favorite', $reply->id) }}" >
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default" {{($reply->isFavorited()) ? 'disabled' : ''}}>
                    {{ $reply->favorites_count . ' ' . str_plural('Favorite', $reply->favorites_count) }} 
                </button>
            </form>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->body }}
    </div>

    @can('update', $reply)
        <div class="panel-footer">
            <form method="POST" action="/replies/{{ $reply->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button class="btn btn-xs btn-danger">Delete</button>
            </form>
        </div>
    @endcan
</div>