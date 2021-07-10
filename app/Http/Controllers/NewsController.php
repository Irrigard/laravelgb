<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function welcome()
    {
        return view('news.welcome');
    }

    public function categories()
    {
        return view('news.categories', [
            'categoriesList'=>$this->getCategories()
        ]);
    }

    public function categoryNews($id)
    {
        return view('news.categoryNews', [
            'id' => $id,
            'newsList'=>$this->getNews()
        ]);
    }

    public function newsItem($catId, $id)
    {
        return view('news.newsItem', [
            'catId' => $catId,
            'id' => $id,
            'newsItemText'=>$this->getText()
        ]);
    }
}
