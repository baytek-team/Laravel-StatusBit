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
        if(config('status.use_history')) {
            collect(config('status.history_models'))->each(function ($model) {
                forward_static_call([$model, 'observe'], StatusObserver::class);
            });
        }

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