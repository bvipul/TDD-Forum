<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Favoritable;

class Reply extends Model
{
    use Favoritable;
    
    protected $fillable = ['body', 'user_id'];

    protected $with = ['favorites', 'owner'];
    
    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
