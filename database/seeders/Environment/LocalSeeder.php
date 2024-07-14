<?php

namespace Database\Seeders\Environment;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $admin = User::firstOrCreate([
            'name' => 'Admin Apotek',
            'email' => 'admin@apotek.test',
        ], [
            'name' => 'Admin Apotek',
            'email' => 'admin@apotek.test',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $owner = User::firstOrCreate([
            'name' => 'Owner Umar',
            'email' => 'owner@apotek.test',
        ], [
            'name' => 'Owner Umar',
            'email' => 'owner@apotek.test',
            'password' => bcrypt('password'),
        ]);
        $owner->assignRole('owner');
        
        $buyer = User::firstOrCreate([
            'name' => 'Joe Ferdiansyah',
            'email' => 'joe@apotek.test',
        ], [
            'name' => 'Joe Ferdiansyah',
            'email' => 'joe@apotek.test',
            'password' => bcrypt('password'),
        ]);
        $buyer->assignRole('buyer');
    }
}
