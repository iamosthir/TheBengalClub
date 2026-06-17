<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|image|max:4096',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'delivery_charge' => 'nullable|numeric|min:0',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);
        $data['is_active']       = $request->boolean('is_active', true);
        $data['delivery_charge'] = $data['delivery_charge'] ?? 0;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|image|max:4096',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'delivery_charge' => 'nullable|numeric|min:0',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        unset($data['image']);
        $data['is_active']       = $request->boolean('is_active');
        $data['delivery_charge'] = $data['delivery_charge'] ?? 0;

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
