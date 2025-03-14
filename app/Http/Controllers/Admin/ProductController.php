<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imagePath = null;

         if ($request->hasFile('image')) {
            $request->file('image')->move(public_path('products'), $request->file('image')->getClientOriginalName());
            $imagePath = 'products/' . $request->file('image')->getClientOriginalName();
          }

        Product::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);


        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imagePath = null;

         if ($request->hasFile('image')) {
            $request->file('image')->move(public_path('products'), $request->file('image')->getClientOriginalName());
            $imagePath = 'products/' . $request->file('image')->getClientOriginalName();
          }

        $product->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $isReferencedInOrderCart = $product->orderCartItems()->exists();
        $isReferencedInCartItems = $product->cartItems()->exists();

        if ($isReferencedInOrderCart || $isReferencedInCartItems) {
            return redirect()->route('admin.products.index')->with('error', 'Product cannot be deleted as it is referenced in other tables.');
        }
    
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->forcedelete();

        return redirect()->route('admin.products.index')->with('success', 'product deleted successfully');
    }

}
