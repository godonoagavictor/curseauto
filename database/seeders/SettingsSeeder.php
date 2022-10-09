<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        nova_set_setting_value('hero_image');

        // Application settings
        nova_set_setting_value('app_name', [
            'ro' => config('app.name'),
            'ru' => config('app.name'),
            'en' => config('app.name'),
        ]);       // nova_set_setting_value('app_add_name_as_suffix', false);

        nova_set_setting_value('app_maintenance_enabled', false);
        nova_set_setting_value('app_maintenance_secret', (string) Str::orderedUuid());
        nova_set_setting_value('app_maintenance_message', [
            'ro' => __('Service Unavailable', [], 'ro'),
            'ru' => __('Service Unavailable', [], 'ru'),
            'en' => __('Service Unavailable', [], 'en'),
        ]);

        // JsonLd\LocalBusiness
        nova_set_setting_value('bussiness_enabled', true);
        nova_set_setting_value('bussiness_name', [
            'ro' => config('app.name'),
            'ru' => config('app.name'),
            'en' => config('app.name'),
        ]);
        nova_set_setting_value('bussiness_url', config('app.url'));
    }
}
