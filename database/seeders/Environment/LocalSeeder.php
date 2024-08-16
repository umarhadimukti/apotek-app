<?php

namespace Database\Seeders\Environment;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
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


        Category::create([
            'name' => 'Pertolongan Pertama',
            'slug' => 'pertolongan-pertama',
        ]);
        Category::create([
            'name' => 'Obat Kepala',
            'slug' => 'obat-kepala',
        ]);
        Category::create([
            'name' => 'Obat Perut',
            'slug' => 'obat-perut',
        ]);
        Category::create([
            'name' => 'Obat Demam',
            'slug' => 'obat-demam',
        ]);
        Category::create([
            'name' => 'Obat Batuk',
            'slug' => 'obat-batuk',
        ]);


        $this->call(ProductSeeder::class);

    }
}
