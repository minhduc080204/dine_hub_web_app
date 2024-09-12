<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        //BLADE----------------------------------------
        Blade::directive('activeClass', function ($route) {
            return "<?php echo request()->routeIs($route) ? '' : 'collapsed'; ?>";
        });
    }
}