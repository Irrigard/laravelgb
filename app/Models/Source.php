<?php declare(strict_types=1);

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';
    protected $fillable = [
        'title'
    ];

    public function getSources()
    {
        return \DB::table($this->table)
            ->select(['id', 'title', 'created_at'])
            ->orderBy('id')
            ->get();
    }

    public function getSourceById(int $id)
    {
        return \DB::table($this->table)
            ->find($id);
    }
}
