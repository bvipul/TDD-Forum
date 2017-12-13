<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels', function(){
                return Channel::all();                
            });
            $view->with('channels',  $channels);
        });

        // View::composer('*', function ($view) {
        //     $user = \Cache::rememberForever('logged_in_user', function(){
        //         if(auth()->check()) {
        //             return auth()->user()->id;                
        //         }
        //         // return 
        //     });
        //     $view->with('logged_in_user',  $user);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
