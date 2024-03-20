<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tags';
    protected $fillable = [
        'title',
    ];

    protected $dates = ['created_at'];

    public function news() {
        return $this->belongsToMany(News::class, 'news_tags', 'news_id', 'tag_id');
    }
}
