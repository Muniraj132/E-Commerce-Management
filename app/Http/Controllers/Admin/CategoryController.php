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
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.categories.index', compact('categories'));
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
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $request->input('status');

        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->move(public_path('categories'), $request->file('category_image')->getClientOriginalName());
            $category->category_image = 'categories/' . $request->file('category_image')->getClientOriginalName();
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');

          if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->move(public_path('categories'), $request->file('category_image')->getClientOriginalName());
            $category->category_image = 'categories/' . $request->file('category_image')->getClientOriginalName();
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Category cannot be deleted as it is referenced in the Product table.');
        }


        if ($category->category_image && file_exists(public_path($category->category_image))) {
            unlink(public_path($category->category_image));
        }

        $category->forceDelete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
