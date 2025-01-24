<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('states')->delete();
        DB::table('districts')->delete();
        DB::table('districtcourts')->delete();
        $this->call([
            StateSeeder::class,
            DistrictSeeder::class,
            DistrictCourt::class,
        ]);
         
    }
}
