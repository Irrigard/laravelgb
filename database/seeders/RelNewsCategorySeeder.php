<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class RelNewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rel_news_categories')->insert($this->getData());
    }

    public function getData(): array
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++){
            $data[] = [
                'news_id' => $i,
                'category_id' => mt_rand(1, 6)
            ];
        }

        return $data;
    }
}
