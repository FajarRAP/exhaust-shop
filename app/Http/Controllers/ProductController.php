<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Traits\HasPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use HasPagination;

    protected function targetModel(): string
    {
        return Product::class;
    }

    public function index()
    {
        $products = $this->paginate(relations: ['category']);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'name.unique' => __('This exhaust product name already exists, please use a different name.'),
            'category_id.exists' => __('The selected category is invalid.')
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', __('Product has been added successfully!'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', "unique:products,name,$product->id"],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);


        if ($request->hasFile('image')) {
            if ($this->fileExists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', __('Product has been updated successfully!'));
    }

    public function destroy(Product $product)
    {
        if ($this->fileExists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', __('Product has been deleted successfully!'));
    }

    private function fileExists(string $path): bool
    {
        return $path && Storage::disk('public')->exists($path);
    }
}
