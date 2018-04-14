<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordsActivity;

class Favorite extends Model
{
    use RecordsActivity;

    protected $guarded = ['id'];

    protected $with = ['owner', 'favorited'];

    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function favorited()
    {
        return $this->morphTo();
    }

}
