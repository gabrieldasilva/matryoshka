<?php

namespace GDasilva\Matryoshka;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MatryoshkaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class, function()
        {
            return new BladeDirective(
                new RussianCaching(app('Illuminate\Contracts\Cache\Repository'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function($expresion)
        {
            return "<?php if ( ! app('GDasilva\Matryoshka\BladeDirective')->setUp({$expresion})) { ?>";
        });

        Blade::directive('endcache', function()
        {
            return "<?php } echo app('GDasilva\Matryoshka\BladeDirective')->tearDown(); ?>";
        });
    }
}
