<?php

namespace RevoLand\ParamLaravel;

class ParamServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/paramlaravel.php' => config_path('paramlaravel.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config/paramlaravel.php', 'paramlaravel');
    }

    public function register()
    {
        $this->app->bind(Param::class);
    }
}
