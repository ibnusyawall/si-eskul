<?php

namespace Database\Seeders;

use App\Models\SubBab;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            UserSeeder::class,
            EskulSeeder::class,
            AnggotaSeeder::class,
            BabSeeder::class,
            SubBabSeeder::class,
        ];

        $this->call($seeds);
    }
}
