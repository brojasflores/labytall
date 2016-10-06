<?php 

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;
use App\Utils\SepaUserProvider;

class SepaAuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Auth::provider('sepa', function ($app, array $config) {
            return new SepaUserProvider($config['model']);
        });
    }

    public function register()
    {
    }
}