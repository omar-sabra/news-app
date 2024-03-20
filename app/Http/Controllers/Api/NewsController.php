<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Models\News;
use App\Models\NewsTags;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function latestNews()
    {

        $latestNews = News::with('media')->with('news_tags')->latest()->get();
//        return $latestNews;

        return response()->json([
            'status' => true,
            'message' => 'latest news',
            'news' => NewsCollection::collection($latestNews),
        ]);
    }
}
