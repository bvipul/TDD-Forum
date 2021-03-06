<?php

namespace App;

use App\User;
use App\Thread;
use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
    
    protected $fillable = ['body', 'user_id'];

    protected $with = ['thread', 'owner'];

    protected $appends = ['favoritesCount'];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path() {
        return $this->thread->path() . '#reply-' . $this->id;
    }
}
