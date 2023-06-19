<?php

namespace Database\Seeders;

use Database\Seeders\Oficina\{
    ResourceSeeder,
    RoleSeeder,
};

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ResourceSeeder::class,
        ]);
    }
}
