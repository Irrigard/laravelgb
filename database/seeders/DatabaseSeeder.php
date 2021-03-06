<?php

namespace Database\Seeders;

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
        $this->call([CategorySeeder::class, NewsSeeder::class, SourceSeeder::class, RelNewsCategorySeeder::class, RelNewsSourceSeeder::class]);
        //$this->call([RelNewsCategorySeeder::class, RelNewsSourceSeeder::class]);
        // \App\Models\User::factory(10)->create();
    }
}
