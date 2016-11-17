<?php

namespace Baytek\LaravelStatusBit;

use Event;
use Illuminate\Support\ServiceProvider;

class StatusBitServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Event::listen('SomeEvent', 'SomeEventHandler');
        //
        $this->publishes([
            __DIR__.'/config/status.php' => config_path('status.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }

}