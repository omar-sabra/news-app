<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'description',
        'custom_date',
        'category_id',
    ];
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function media() {
        return $this->hasMany(Media::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'news_tags', 'tag_id', 'news_id');
    }

    public function news_tags() {
        return $this->hasMany(NewsTags::class);
    }

}
