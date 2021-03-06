<?php declare(strict_types=1);


namespace App\Services;


use App\Contracts\Parser;
use App\Models\Category;
use App\Models\News;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{
    public function getParsedList(string $url): array
    {
        $xml = XmlParser::load($url);
        $data = $xml->parse([
           'title' => [
               'uses' => 'channel.title'
           ],
           'link' => [
               'uses' => 'channel.link'
           ],
           'description' => [
               'uses' => 'channel.description'
           ],
           'image' => [
               'uses' => 'channel.image.url'
           ],
           'news' => [
               'uses' => 'channel.item[title,link,guid,description,pubDate]'
           ]
        ]);
        return $data;
    }

    public function saveNewsInDatabase(\stdClass $source)
    {
        $category = new Category();
        $news = new News();
        $parsedList = $this->getParsedList($source->url);
        $explodedTitle = explode('-', $source->title);
        $parsingCategory = end($explodedTitle);
        $categoryId = $category->getCategoryByName($parsingCategory)->id;
        $news->saveParsedNews($parsedList, $categoryId, $source->id);
    }
}
