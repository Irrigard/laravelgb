<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;

class RelNewsSourceSeeder extends Seeder
{
    public function run()
    {
        \DB::table('rel_news_sources')->insert($this->getData());
    }

    public function getData(): array
    {
        $data = [];

        for ($i = 1; $i <=10; $i++){
            $data[] = [
                'news_id' => $i,
                'source_id' => mt_rand(1, 5)
            ];
        }

        return $data;
    }
}
