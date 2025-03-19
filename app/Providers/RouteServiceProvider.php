<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider{
    /**
     * The path to your application's "home" route.
     * Typcally, users are redirected here after authentication
     * 
     * @var string
     */

     public const HOME = '/home';

     /**
      * Define your route model bliding, pattern filters, and other router configuration
      */
    
     public function boot():void{
        

        $this->routes(function(){
            Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

    
        });
     }
}