<?php

namespace maree\elmWasl;

use Illuminate\Support\ServiceProvider;

class ElmWaslServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/elm-wasl.php' => config_path('elm-wasl.php'),
        ],'elm-wasl');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/elm-wasl.php', 'elm-wasl'
        );
    }
}
