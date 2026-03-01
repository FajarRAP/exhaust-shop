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
            'name' => 'required|string|max:255|unique:categories,name'
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Nama kategori sudah digunakan, silakan pilih yang lain.'
        ]);


        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);


        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori Knalpot berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([

            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ], [
            'name.required' => 'Nama kategori wajib diisi!'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori Knalpot berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori gagal dihapus karena masih memiliki produk knalpot!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
