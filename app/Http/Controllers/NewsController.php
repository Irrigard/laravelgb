<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function welcome()
    {
        return view('news.welcome');
    }

    public function categories()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        return view('news.categories', [
            'categoriesList'=>$categories
        ]);
    }

    public function categoryNews($id)
    {
        $news = \DB::table('relationships')
            ->join('news', 'relationships.news_id', '=', 'news.id')
            ->join('categories', 'relationships.category_id', '=', 'categories.id')
            ->select(['news.id as newsId', 'news.title as newsTitle'])
            ->where([
                ['categories.id', '=', $id]
            ])
            ->get();
        return view('news.categoryNews', [
            'id' => $id,
            'newsList'=>$news
        ]);
    }

    public function newsItem($catId, $id)
    {
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);
        return view('news.newsItem', [
            'catId' => $catId,
            'id' => $id,
            'newsItem'=>$news
        ]);
    }
}
