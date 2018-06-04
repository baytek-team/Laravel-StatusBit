<?php

/*
 * This file is part of the Laravel StatusBit package.
 *
 * (c) Yvon Viger <yvon@baytek.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Baytek\Laravel\StatusBit;

use Event;
use Illuminate\Support\ServiceProvider;
use Baytek\Laravel\StatusBit\StatusMessages;

class StatusBitServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('status.use_history')) {
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
