<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\News;
use App\Models\Source;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

class ParserController extends Controller
{
    private $parseUrls = [
        'music' => 'https://news.yandex.ru/computers.rss',
        'sport' => 'https://news.yandex.ru/sport.rss',
        'computers' => 'https://news.yandex.ru/computers.rss'
    ];

    public function parse($category, Parser $service, News $news): RedirectResponse
    {
        $statusNews = $news->saveParsedNews($service->getParsedList("https://news.yandex.ru/$category.rss"), 0, 0);

        if ($statusNews) {
            return redirect()->route('admin.news.index')->with('success', 'Парсинг успешно завершен.');
        }
        return redirect()->route('admin.news.index')->with('error', 'Не удалось провести парсинг.');
    }

    public function __invoke(Request $request, Parser $service, Source $source): RedirectResponse
    {
        $sources = $source->getSources();
        foreach ($sources as $source)
        {
            $this->dispatch(new NewsParsing($source));
        }
        return redirect()->route('admin.news.index')->with('success', 'Парсинг успешно завершен.');
    }
}
