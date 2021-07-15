<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('relationships')->insert($this->getData());
    }

    public function getData(): array
    {
        $data = [];

        for ($i = 0; $i < 5; $i++){
            $data[] = [
                'category_id' => mt_rand(1, 5),
                'news_id' => mt_rand(1, 10),
                'source_id' => mt_rand(1, 5)
            ];
        }

        return $data;
    }
}
