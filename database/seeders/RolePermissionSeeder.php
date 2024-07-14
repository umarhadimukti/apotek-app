<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'owner',
        ], [
            'name' => 'owner',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'buyer',
        ], [
            'name' => 'buyer',
            'guard_name' => 'web',
        ]);
    }
}
