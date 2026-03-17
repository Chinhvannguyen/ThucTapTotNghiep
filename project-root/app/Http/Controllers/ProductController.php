<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', 1);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderByRaw('COALESCE(sale_price, price) ASC');
                    break;

                case 'price_desc':
                    $query->orderByRaw('COALESCE(sale_price, price) DESC');
                    break;

                case 'oldest':
                    $query->oldest('id');
                    break;

                default:
                    $query->latest('id');
                    break;
            }
        } else {
            $query->latest('id');
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'images',
            'reviews.user',
        ]);

        $relatedProducts = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, function ($query) use ($product) {
                $query->where('category_id', $product->category_id);
            })
            ->latest('id')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $keyword = trim((string) $request->get('keyword', ''));

        $products = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', 1)
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                });
            })
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('products.search', compact('products', 'keyword'));
    }
}