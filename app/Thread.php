<?php

namespace App;

use App\Activity;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = ['id'];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread) {
            $thread->replies()->delete();
        });
    }

    public function path() 
    {
        return '/threads/' . $this->channel->slug . '/' . $this->id;
    }

    public function replies()
    {
        return $this->hasMany(\App\Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(\App\Channel::class);
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
