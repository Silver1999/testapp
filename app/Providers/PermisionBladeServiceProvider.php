<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermisionBladeServiceProvider extends ServiceProvider
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
        Blade::directive('permission', function ($permission){
            return "<?php if(auth()->check() && auth()->user()->hasPermissionTo({$permission})): ?>";
        });
        Blade::directive('endpermission', function ($permission){
            return "<?php endif; ?>";
        });
    }
}
