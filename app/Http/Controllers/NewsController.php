<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function welcome()
    {
        return view('News.welcome');
    }

    public function categories()
    {
        return view('News.categories', [
            'categoriesList'=>$this->getCategories()
        ]);
    }

    public function categoryNews($id)
    {
        return view('News.categoryNews', [
            'id' => $id,
            'newsList'=>$this->getNews()
        ]);
    }

    public function newsItem($catId, $id)
    {
        return view('News.newsItem', [
            'catId' => $catId,
            'id' => $id,
            'newsItemText'=>$this->getText()
        ]);
    }
}
