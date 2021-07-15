<?php declare(strict_types=1);


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    public function getNews()
    {
        return \DB::table($this->table)
            ->select(['id', 'title', 'slug', 'description', 'created_at'])
            ->get();
    }

    public function getNewsById(int $id)
    {
        return \DB::table($this->table)
            ->find($id);
    }
}
