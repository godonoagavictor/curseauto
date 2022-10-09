<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Silvanite\Brandenburg\Role::firstOrCreate([
            'name' => 'Super Administrator',
            'slug' => 'super-administrator'
        ]);
    }
}
