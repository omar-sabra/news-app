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
        return $this->belongsToMany(Tag::class, 'news_tags', 'tag_id', 'news_id');
    }

    public function news() {
        return $this->belongsToMany(News::class, 'news_tags', 'news_id', 'tag_id');
    }
}
