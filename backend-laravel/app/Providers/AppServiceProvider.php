<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;

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
        // URL::forceScheme('https');
        Paginator::useBootstrapFive();

        //BLADE----------------------------------------
        Blade::directive('activeClass', function ($route) {
            return "<?php echo request()->routeIs($route) ? '' : 'collapsed'; ?>";
        });
        Blade::directive('errorDirective', function ($title) {
            return
                "<?php echo \$errors->first($title) ? '<label class=\"text-danger\">' .'<i class=\"bi bi-exclamation-circle mx-1\"></i>' . \$errors->first($title) . '</label>' : ''; ?>";
        });
        Blade::directive('deleteItem', function ($params) {
            list($route, $id) = explode(',', $params);
            return "<?php echo '<form action=\"' . route(trim($route), trim($id)) . '\" method=\"POST\">' .
               csrf_field() . 
               method_field('delete') . 
               '<button class=\"dropdown-item\"><i class=\"bi bi-trash\"></i> Xoá</button></form>'; ?>";
        });

    }
}