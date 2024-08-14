<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Country::factory(20)->create();
\App\Models\City::factory(200)->create();
\App\Models\FamousPlace::factory(25)->create();
\App\Models\Hotel::factory(75)->create();
\App\Models\Photof::factory(50)->create();
\App\Models\Place::factory(50)->create();
\App\Models\Photop::factory(50)->create();
\App\Models\User::factory(10)->create();
    //\App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
}
}
