<?php

namespace App\Observers;

use Illuminate\Support\Facades\Artisan;
use OptimistDigital\NovaSettings\Models\Settings;

class SettingsObserver
{
    /**
     * Handle the Settings "created" event.
     *
     * @param  \OptimistDigital\NovaSettings\Models\Settings  $settings
     * @return void
     */
    public function created(Settings $settings)
    {
        // maintenance mode enabled, put app down
        if ($settings->key === 'app_maintenance_enabled') {
            if ((bool) $settings->value) {
                Artisan::call('down --secret="'.nova_get_setting('app_maintenance_secret').'"');
            } else {
                Artisan::call('up');
                nova_set_setting_value('app_maintenance_secret', (string) \Illuminate\Support\Str::orderedUuid());
            }
        }
    }

    /**
     * Handle the Settings "updated" event.
     *
     * @param  \OptimistDigital\NovaSettings\Models\Settings  $settings
     * @return void
     */
    public function updated(Settings $settings)
    {
        // maintenance mode enabled, put app down
        if ($settings->key === 'app_maintenance_enabled') {
            if ((bool) $settings->value) {
                Artisan::call('down --secret="'.nova_get_setting('app_maintenance_secret').'"');
            } else {
                Artisan::call('up');
                nova_set_setting_value('app_maintenance_secret', (string) \Illuminate\Support\Str::orderedUuid());
            }
        }
    }

    /**
     * Handle the Settings "deleted" event.
     *
     * @param  \OptimistDigital\NovaSettings\Models\Settings  $settings
     * @return void
     */
    public function deleted(Settings $settings)
    {
        //
    }

    /**
     * Handle the Settings "forceDeleted" event.
     *
     * @param  \OptimistDigital\NovaSettings\Models\Settings  $settings
     * @return void
     */
    public function forceDeleted(Settings $settings)
    {
        //
    }
}
