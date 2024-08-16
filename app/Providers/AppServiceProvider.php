<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        $this->bootBladeDirectives();
    }

    public function bootBladeDirectives()
    {
        Blade::directive('currencyIdr', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 0, ',', '.'); ?>";
        });
    }
}
