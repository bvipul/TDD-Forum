<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $activities = $user->activity()->with('subject')->latest()->get()->groupBy(function($activity){
            return $activity->created_at->format('d-m-Y');
        });
        return view('profile.show', [
            'profileUser' => $user,
            'activities' => $activities
        ]);
    }
}
