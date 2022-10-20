<?php

namespace App\Providers;

use App\Http\Services\RateConverter\ConvertUsdToEur;
use App\Http\Services\RateConverter\RateConverter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RateConverter::class,function ($app){
            return new ConvertUsdToEur();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
