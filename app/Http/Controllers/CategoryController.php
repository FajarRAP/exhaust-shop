<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\HasPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use HasPagination;

    protected function targetModel(): string
    {
        return Category::class;
    }

    public function index()
    {
        $categories = $this->paginate();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name']
        ], [
            'name.required' => __('Category name is required!'),
            'name.unique' => __('Category name has already been taken, please choose another.')
        ]);


        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);


        return redirect()->route('admin.categories.index')
            ->with('success', __('Exhaust category has been added successfully!'));
    }

    public function edit(Category $category)
    {

        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:categories,name,$category->id"]
        ], [
            'name.required' => __('Category name is required!')
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', __('Exhaust category has been updated successfully!'));
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', __('Category could not be deleted because it still has associated products!'));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', __('Category has been deleted successfully!'));
    }
}
