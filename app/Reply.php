<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body', 'user_id'];
    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
