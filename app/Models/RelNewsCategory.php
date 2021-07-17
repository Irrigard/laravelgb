<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RelNewsCategory extends Model
{
    protected $table = "rel_news_categories";
    protected $fillable = [
        'category_id',
        'updated_at'
    ];
}
