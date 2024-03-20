<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(5);
        return view('admin.tags.index', compact('tags'));
    }

    public function searchByTag(Request $request) {
        $search = $request->search;
        $tags = Tag::where(function ($query) use ($search) {
           $query->where('title', 'like', "%$search%");
        })->paginate(5);
        return view('admin.tags.index', compact('tags', 'search'));
    }

    public function trashedTags() {
        $tags = Tag::onlyTrashed()->paginate(5);
        return view('admin.tags.trashed-tags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $input = $request->all();
        Tag::create($input);
        return redirect()->route('tags')->with('success', 'Tag Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag_id = Tag::FindOrFail($id);
        $request->validate([
            'title' => 'required|string',
        ]);

        $input = $request->all();
        $tag_id->update($input);
        return redirect()->route('tags')->with('success', 'Tag Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy($id)
//    {
//        $tag_id = Tag::FindOrFail($id);
//        $tag_id->delete();
//        return redirect()->route('tags')->with('success', 'Tag Deleted Successfully');
//    }

    public function softDelete($id) {
        $tag_id = Tag::find($id);
        $tag_id->delete();
        return redirect()->route('tags')->with('success', 'Tag Deleted Successfully');
    }
}
