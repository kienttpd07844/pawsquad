<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();
        if (!$category) {
            return redirect()->back()->withErrorMessage('Không tìm thấy danh mục này.');
        }
        $childCategories = $category->children;
        $products = Product::whereIn('category_id', $childCategories->pluck('id'))->get();
        $brands = Brand::IsActive()->where('slug', '!=', 'uncategorized')
            ->whereIn('id', $products->pluck('brand_id'))->get();
        return view('clients.category.index', compact('childCategories', 'category', 'brands', 'products'));
    }
    public function filter(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 9;
        $sortBy = $request->sort_by ? $request->sort_by : "created_at";
        $sortOrder = $request->sort_order ? $request->sort_order : "desc";
        $category = Category::where('slug', $request->slug)->first();
        if (!$category) {
            return redirect()->back()->withErrorMessage('Không tìm thấy danh mục này.');
        }
        $childCategories = $category->children;
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;
        if (in_array($priceMin, [0, 1000]) && in_array($priceMax, [500, 1000])) {
            $priceMin = null;
            $priceMax = null;
        } else {
            // Gán giá trị mặc định nếu không có giá trị
            $priceMin = $priceMin ?? 0;
            $priceMax = $priceMax ?? 500;
        }
        if (!$request->category && !$request->input('order') && ($priceMin == 0 || $priceMin == 1000) && ($priceMax == 500 || $priceMax == 1000)) {
            $products = Product::whereIn('category_id', $childCategories->pluck('id'))
                ->with('category')->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $products = Product::whereIn('category_id', $childCategories->pluck('id'))
                ->with('category')
                ->when($request->category, function ($query) use ($request) {
                    return $query->whereHas('category', function ($query) use ($request) {
                        $query->where('slug', $request->category);
                    });
                })
                ->when($priceMin || $priceMax, function ($query) use ($priceMin, $priceMax) {
                    return $query->where(function ($query) use ($priceMin, $priceMax) {
                        // Lọc theo giá
                        if ($priceMin) {
                            $query->where('min_price', '>=', $priceMin);
                        }
                        if ($priceMax) {
                            $query->where(function ($subQuery) use ($priceMin, $priceMax) {
                                // Thỏa mãn nếu max_price lớn hơn 0 và nhỏ hơn hoặc bằng price_max,
                                // hoặc min_price nằm trong khoảng price_min và price_max
                                $subQuery->where('max_price', '<=', $priceMax)
                                    ->orWhere(function ($orQuery) use ($priceMin, $priceMax) {
                                        $orQuery->where('min_price', '>=', $priceMin)
                                            ->where('min_price', '<=', $priceMax);
                                    });
                            });
                        }
                    });
                })

                ->when($request->order, function ($query) use ($request) {
                    switch ($request->order) {
                        case '1':
                            return $query->orderBy('created_at', 'desc'); // Mới nhất
                        case '2':
                            return $query->orderBy('views', 'desc'); // Nhiều lượt xem
                        case '3':
                            return $query->orderBy('min_price', 'desc'); // Giá cao xuống thấp
                        case '4':
                            return $query->orderBy('min_price', 'asc'); // Giá thấp lên cao
                        default:
                            return $query;
                    }
                })
                ->orderBy($sortBy, $sortOrder)
                ->paginate($perPage);
        }



        return $this->getProduct($products);
    }



    private function getProduct($products)
    {
        return [
            'success'           => true,
            'products'          => getRender('clients.partials.product', ['products' => $products]),
        ];
    }
}
