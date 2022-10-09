<?php

namespace App\Providers;

use App\Observers\SettingsObserver;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Statikbe\NovaTranslationManager\TranslationManager::setLocales(
            array_keys(
                config('laravellocalization.supportedLocales')
            )
        );

        \OptimistDigital\NovaSettings\Models\Settings::observe(SettingsObserver::class);
    }
}
