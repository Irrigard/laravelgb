<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected array $categories;
    protected array $news;

    protected function getCategories():array
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i <= 9; $i++)
        {
            $this->categories[] = $faker->word();
        }
        return $this->categories;
    }

    protected function getNews():array
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i <= 5; $i++)
        {
            $this->news[] = $faker->word();
        }
        return $this->news;
    }

    protected function getText():string
    {
        $faker = Factory::create('ru_RU');
        return $faker->text();
    }
}
