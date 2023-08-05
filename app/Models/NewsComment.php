<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsComment extends Model
{
    use HasFactory;
    protected $table = 'news_comment';
    public $timestamps = true;
    protected $fillable = [
        'news_id',
        'users_id',
        'comment',
    ];
    public function user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
