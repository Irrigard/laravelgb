<?php declare(strict_types=1);


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Source;
use App\Models\RelNewsCategory;
use App\Models\RelNewsSource;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    protected $table = "news";
    protected $fillable = [
        'title',
        'description',
        'slug',
        'image',
        'status',
        'updated_at'
    ];

    public function relNewsCategory(): HasOne
    {
        return $this->hasOne(RelNewsCategory::class);
    }

    public function relNewsSource(): HasOne
    {
        return $this->hasOne(RelNewsSource::class);
    }

    public function getNews()
    {
        /*return \DB::table($this->table)
            ->select(['id', 'title', 'slug', 'description', 'created_at'])
            ->get();*/

        return \DB::table($this->table)
            ->join('rel_news_categories', 'news.id', '=', 'rel_news_categories.news_id')
            ->join('categories', 'rel_news_categories.category_id', '=', 'categories.id')
            ->join('rel_news_sources', 'news.id', '=', 'rel_news_sources.news_id')
            ->join('sources', 'rel_news_sources.source_id', '=', 'sources.id')
            ->select(['news.id as id', 'news.title as title', 'slug', 'news.description as description',
                'news.created_at as created_at', 'image', 'status',
                'categories.title as categoryTitle', 'sources.title as sourceTitle'])
            ->get();
    }

    public function getNewsById(int $id)
    {
        /*return \DB::table($this->table)
            ->find($id);*/

        return \DB::table($this->table)
            ->join('rel_news_categories', 'news.id', '=', 'rel_news_categories.news_id')
            ->join('categories', 'rel_news_categories.category_id', '=', 'categories.id')
            ->join('rel_news_sources', 'news.id', '=', 'rel_news_sources.news_id')
            ->join('sources', 'rel_news_sources.source_id', '=', 'sources.id')
            ->select(['news.id as id', 'news.title as title', 'slug', 'news.description as description',
                'news.created_at as created_at', 'image', 'status',
                'categories.title as categoryTitle', 'sources.title as sourceTitle'])
            ->where([
                ['news.id', '=', $id]
            ])
            ->get();
    }

    public function createNews(Request $request):bool
    {
        $slug = \Str::slug($request->input('title'));
        $category = Category::where([
            ['title', '=', $request->input('category')]
        ])
            ->select(['id'])
            ->first();
        $source = Source::where([
            ['title', '=', $request->input('source')]
        ])
            ->select(['id'])
            ->first();
        $newsId = \DB::table($this->table)->insertGetId([
            'title' => $request->input('title'),
            'slug' => $slug,
            'image' => $request->input('image'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $categoryStatus = \DB::table('rel_news_categories')->insertOrIgnore([
            'news_id' => $newsId,
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $sourceStatus = \DB::table('rel_news_sources')->insertOrIgnore([
            'news_id' => $newsId,
            'source_id' => $source->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if (is_numeric($newsId) && $categoryStatus && $sourceStatus){
            return true;
        }
        return false;

    }

    public function updateNews(Request $request, News $news):bool
    {
        $slug = \Str::slug($request->input('title'));
        $category = Category::where([
            ['title', '=', $request->input('category')]
        ])
            ->select(['id'])
            ->first();
        $source = Source::where([
            ['title', '=', $request->input('source')]
        ])
            ->select(['id'])
            ->first();
        $relNewsCategory = RelNewsCategory::where('news_id', $news->id)->first();
        $relNewsSource = RelNewsSource::where('news_id', $news->id)->first();
        $newsStatus = $news->fill([
            'title' => $request->input('title'),
            'slug' => $slug,
            'image' => $request->input('image'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'updated_at' => now()
        ])->save();
        if ($relNewsCategory->category_id !== $category->id){
            $categoryStatus = $relNewsCategory->fill([
                'category_id' => $category->id,
                'updated_at' => now()
            ])->save();
        } else {
            $categoryStatus = true;
        }
        if ($relNewsSource->source_id !== $source->id){
            $sourceStatus = $relNewsSource->fill([
                'source_id' => $source->id,
                'updated_at' => now()
            ])->save();
        } else {
            $sourceStatus = true;
        }

        if ($newsStatus && $categoryStatus && $sourceStatus){
            return true;
        }

        return false;
    }
}
