<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="{{ 'reply-'. $reply->id }}" class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <h5 class="flex">
                    <a href="{{ route('profile', $reply->owner) }}">
                        {{ $reply->owner->name }}
                    </a>
                    said {{ $reply->created_at->diffForHumans() }}
                </h5>
                <favorite :reply="{{ $reply }}"></favorite>
            </div>
        </div>

        <div class="panel-body">
            <div v-if="editing">
                <textarea name="reply" class="form-control" v-model="body"></textarea>
            </div>
            <div v-else>
                @{{ body }}                
            </div>
        </div>

        @can('update', $reply)
            <div class="panel-footer">
                <div v-if="!editing" class="level">
                    <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                    <button class="btn btn-xs btn-danger" @click="destroy">Delete</button>
                </div>
                <div class="level" v-else>
                    <button class="btn btn-xs btn-primary mr-1" @click="update">Update</button>
                    <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
                </div>
            </div>
        @endcan
    </div>
</reply>