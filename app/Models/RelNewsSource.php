<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RelNewsSource extends Model
{
    protected $table = "rel_news_sources";
    protected $fillable = [
        'source_id',
        'updated_at'
    ];
}
