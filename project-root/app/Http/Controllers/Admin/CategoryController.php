<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->get('keyword'));

        $categories = Category::when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('slug', 'like', "%{$keyword}%");
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories', 'keyword'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateCategory($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Thêm danh mục thành công.');
    }

    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $this->validateCategory($request, $category->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công.');
    }

    protected function validateCategory(Request $request, ?int $categoryId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => $categoryId
                ? ['nullable', 'string', 'max:255', 'unique:categories,slug,' . $categoryId]
                : ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}