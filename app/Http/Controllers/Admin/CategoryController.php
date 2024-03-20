<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function searchByCategory(Request $request) {
        $search = $request->search;
        $categories = Category::where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
        })->paginate(5);
        return view('admin.categories.index', compact('categories', 'search'));
    }

    public function trashedCategories() {
        $categories = Category::onlyTrashed()->paginate(5);
        return view('admin.categories.trashed-categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $input = $request->all();
        Category::create($input);
        return redirect()->route('categories')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category_id = Category::FindOrFail($id);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $input = $request->all();
        $category_id->update($input);
        return redirect()->route('categories')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy($id)
//    {
//        $category_id = Category::FindOrFail($id);
//        $category_id->delete();
//        return redirect()->route('categories')->with('success', 'Category Deleted Successfully');
//    }

    public function softDelete($id) {
        $category_id = Category::find($id);
        $category_id->delete();
        return redirect()->route('categories')->with('success', 'Category Deleted Successfully');
    }
}
