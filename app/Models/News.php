<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    public $timestamps = true;

    protected $fillable = [
        'image',
        'detil',
        'title',
    ];

    public function comment()
    {
      return  $this->hasMany(NewsComment::class, 'news_id', 'id');
    }
}
