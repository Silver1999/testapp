<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AcountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('account', function (){
            return "<?php if(auth()->check() && auth()->user()->account): ?>";
        });
        Blade::directive('endaccount', function (){
            return "<?php endif; ?>";
        });
    }
}
