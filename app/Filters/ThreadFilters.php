<?php

namespace App\Filters;

use App\User;
use App\Filters\Filters;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];

    /**
     * Filter threads by username
     *
     * @param string $username
     */
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter threads by popularity
     *
     * @return void
     */
    public function popular()
    {
        $this->builder->getQuery()->orders = [];
        
        return $this->builder->orderBy('replies_count', 'desc');
    }
}