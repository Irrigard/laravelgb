<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStore;
use App\Http\Requests\NewsUpdate;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $newsModel = new News();
        $news = $newsModel->getNews();
        return view('admin.news.index', [
            'newsList'=>$news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.news.create', [
            'categories' => Category::select(['id', 'title'])->get(),
            'sources' => Source::select(['id', 'title'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsStore $request
     * @param News $news
     * @return RedirectResponse
     */
    public function store(NewsStore $request, News $news): RedirectResponse
    {
        $statusNews = $news->createNews($request);

        if ($statusNews) {
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно создана.');
        }
        return redirect()->route('admin.news.index')->with('error', 'Не удалось создать запись.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param News $news
     * @return View
     */
    public function edit(News $news): View
    {
        return view('admin.news.edit', [
            'news' => $news->getNewsById($news['id'])[0],
            'categories' => Category::select(['id', 'title'])->get(),
            'sources' => Source::select(['id', 'title'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsUpdate $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(NewsUpdate $request, News $news): RedirectResponse
    {
        $statusNews = $news->updateNews($request, $news);

        if ($statusNews) {
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно изменена.');
        }
        return redirect()->route('admin.news.index')->with('error', 'Не удалось изменить запись.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param News $news
     * @return Response
     */
    public function destroy(Request $request, News $news)
    {
        if ($request->ajax())
        {
            try {
                $news->delete();
            } catch (\Exception $e) {
                report($e);
            }
        }
    }
}
