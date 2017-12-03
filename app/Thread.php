<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = ['id'];

    public function path() 
    {
        return '/threads/' . $this->id;
    }

    public function replies()
    {
        return $this->hasMany(\App\Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }
}
