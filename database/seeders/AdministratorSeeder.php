<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = \Illuminate\Support\Str::random(8);
        if (config('app.env') === 'local') {
            $password = 'password';
        }

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@garaauto.md',
            ],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make($password),
            ]
        );
        $this->command->info("Administrator account has been created with credentials:\n\nLogin: admin@garaauto.md\nPassword: $password\n");
        if ($admin->wasRecentlyCreated) {
            $admin->assignRole('super-administrator');
        }
    }
}
