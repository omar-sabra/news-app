<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\News;
use App\Models\NewsTags;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

class NewsController extends Controller
{
    protected $news;
    public function __construct(){
        $this->news = new News();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('media')->with('tags')->paginate(5);
        foreach ($news as $new) {
            $imgs = $new->media;
            $image = '';
            if (count($imgs) > 0)
                $image = url($imgs[0]->image);
            $new->image = $image;
        }
        foreach ($news as $new) {
            $tags = $new->tags;
            $tag = '';
            if (count($tags) > 0)
                $tag = $tags[0]->title;
            $new->tag = $tag;
        }
        return view('admin.news.index', compact('news'));
//            ->with('i', (request()->input('page', 1) -1) * 5);
    }

    public function searchByNews(Request $request) {
        $search = $request->search;
        $news = News::where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })
            ->orWhereHas('category', function ($query) use ($search){
                $query->where('title', 'like', "%$search%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            })->paginate(5);
        return view('admin.news.index', compact('news', 'search'));
    }

    public function trashedNews() {
        $news = News::onlyTrashed()->with('media')->with('tags')->paginate(5);
        foreach ($news as $new) {
            $imgs = $new->media;
            $image = '';
            if (count($imgs) > 0)
                $image = url($imgs[0]->image);
            $new->image = $image;
        }
        foreach ($news as $new) {
            $tags = $new->tags;
            $tag = '';
            if (count($tags) > 0)
                $tag = $tags[0]->title;
            $new->tag = $tag;
        }
        return view('admin.news.trashed-news', compact('news'));
//            ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.news.create' , compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
//            'custom_date' => date('Ymd').now(),
//            'images' => 'required_without:id',
//            'images.*' => 'mimes:jpeg,jpg,png,gif,csv,webp|max:2048',
            'category_id' => 'required|not_in:0',
        ]);
//        dd($request);
        $date = date('Y-m-d');
        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'custom_date' => Carbon::createFromFormat('Y-m-d',$date),
            'category_id' => $request->category_id,
        ]);

        if ($news) {
            if ($files = $request->file('images')) {
                $request->validate([
                    'images' => 'required_without:id',
                    'images.*' => 'mimes:jpeg,jpg,png,gif,csv,webp|max:2048',
                ]);
//                dd($request);
                foreach ($files as $key => $file) {

                    $destinationPath = 'images/newsImages/';
                    $extension = date('YmdHis'). ".". uniqid(). '.' . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $extension);
//                    dd($request);
                    Media::create(['image' => '/images/newsImages/'.$extension, 'news_id' => $news->id]);
                }
            }

            if ($tags = $request->input('tags')) {
                foreach ($tags as $key => $tag) {
                    NewsTags::create(['news_id' => $news->id, 'tag_id' => $tag]);
                }
            }
        }

        return redirect()->route('news')->with('success', 'News Created Successfully');
    }

    public function viewMedia($id) {
        $images = Media::where('news_id', $id)->orderBy('id', 'asc')->get();
        return view('admin.news.view-media', compact('images'));
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $news = News::with('media')->with('news_tags')->where('id', $id)->first();
//        dd($news);
//        $news= NewsTags::with('tags')->where('news_id', $id)->first();
//        foreach ($news->tags as $key => $item) {
//            echo $item->title;
//        }
//        return $arr;
//        dd($arr);
        return view('admin.news.edit', compact('categories', 'tags', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
//            'custom_date' => date('Ymd').now(),
//            'images' => 'required_without:id',
//            'images.*' => 'mimes:jpeg,jpg,png,gif,csv,webp|max:2048',
            'category_id' => 'required|not_in:0',
        ]);
//        dd($request);
        $date = date('Y-m-d');
        $news = News::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'custom_date' => Carbon::createFromFormat('Y-m-d',$date),
            'category_id' => $request->category_id,
        ]);

        $medias = Media::where('news_id', $id)->count();
        for ($i = 0; $i < $medias; $i++) {
            if ($file = $request->file('image-'.$i)) {
                $request->validate([
                    'image-'.$i => 'required|mimes:jpeg,jpg,png,gif,csv,webp|max:2048',
                ]);
                $destinationPath = 'images/newsImages/';
                $extension = date('YmdHis'). ".". uniqid(). '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $extension);
                $media_id = $request["media_$i"];
                $media = Media::where('id', $media_id)->first();
//                dd($media->image);
                File::delete(public_path($media->image));

                Media::findOrFail($media_id)->fill(['image' => '/images/newsImages/' . $extension])->save();
            }
        }
            if ($files = $request->file('images')) {
                $request->validate([
                    'images' => 'required_without:id',
                    'images.*' => 'mimes:jpeg,jpg,png,gif,csv,webp|max:2048',
                ]);

                foreach ($files as $key => $file) {

                    $destinationPath = 'images/newsImages/';
                    $extension = date('YmdHis'). ".". uniqid(). '.' . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $extension);
//                    dd($request);
                    Media::create(['image' => '/images/newsImages/'.$extension, 'news_id' => $id]);
                }
            }

            if ($tags = $request->input('tags')) {
                foreach ($tags as $key => $tag) {
                    NewsTags::where('news_id', $id)->update(['tag_id' => $tag]);
                }
            }
        return redirect()->route('news')->with('success', 'News Updated Successfully');
    }

    public function removeImageNews(Request $request) {
        $media = Media::where('id', $request->position)->first();
        File::delete(public_path($media->image));
        $media->delete();
        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy($id)
//    {
//        $news_id = News::FindOrFail($id);
//        $news_id->delete();
//        return redirect()->route('news')->with('success', 'News Deleted Successfully');
//    }

    public function softDelete($id) {
        $news = News::find($id);
        $news->delete();
        return redirect()->route('news')->with('success', 'News Deleted Successfully');
    }
}
