<?php

namespace BukkuAccounting\OpenExchangeRatesSdk\Providers;

use Illuminate\Support\ServiceProvider;

class oerSdkProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}