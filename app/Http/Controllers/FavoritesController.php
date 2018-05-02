<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Reply $reply)
    {
        $reply->favorite();

        if($request->expectsJson()) {
            return response(['status' => 'Reply Favorited', 'count' => $reply->favorites_count]);
        }
        
        return back();
    }
}
