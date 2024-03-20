<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTags extends Model
{
    use HasFactory;
    protected $table = 'news_tags';
    protected $fillable = [
        'news_id',
        'tag_id',
    ];

    public function tags() {
        return $this->belongsTo(Tag::class,  'tag_id', 'id');
    }

    public function news() {
        return $this->belongsTo(News::class,  'news_id', 'id');
    }
}
