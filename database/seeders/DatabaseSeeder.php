<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Database\Seeders\Environment\LocalSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        switch (App::environment()) {
            case 'local':
                $this->call(LocalSeeder::class);
                break;
            default;
                break;
        }
    }
}
