<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();
        if (!$category) {
            return redirect()->back()->withErrorMessage('Không tìm thấy danh mục này.');
        }
        $childCategories = $category->children;
        $products = Product::where('category_id', $childCategories->pluck('id'))->get();
        $brands = Brand::IsActive()->where('slug','!=','uncategorized')
        ->whereIn('id', $products->pluck('brand_id'))->get();
        // dd($brands);
        return view('clients.category.index', compact('childCategories','category','brands'));
    }
}
