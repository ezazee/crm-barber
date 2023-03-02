<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'api',
        ]);

        Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'api',
        ]);

        Role::firstOrCreate([
            'name' => 'Local Admin',
            'guard_name' => 'api',
        ]);

        Role::firstOrCreate([
            'name' => 'Merchant',
            'guard_name' => 'api',
        ]);

        Role::firstOrCreate([
            'name' => 'Customer',
            'guard_name' => 'api',
        ]);

        Role::firstOrCreate([
            'name' => 'Driver',
            'guard_name' => 'api',
        ]);
    }
}
