<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductVariationInfoResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        $categories = Category::where('slug', '!=', 'uncategorized')->IsActive()->isParent()->with('children')->get();
        $brands = Brand::IsActive()->where('slug', '!=', 'uncategorized')->get();
        return view('clients.product.index', compact('categories', 'brands'));
    }
    public function filter(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 9;
        $sortBy = $request->sort_by ? $request->sort_by : "created_at";
        $sortOrder = $request->sort_order ? $request->sort_order : "desc";
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
            $products = Product::with('category')->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $products = Product::with('category')
                ->when($request->search, function ($query) use ($request) {
                    return $query->whereRaw('MATCH(name) AGAINST(? IN NATURAL LANGUAGE MODE)', [$request->search]);
                })
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
    public function detail(Request $request)
    {
        $product = Product::with('category')->isActive()->where('slug', $request->slug)->first();
        if (!$product) {
            return redirect()->route('product')->withErrorMessage('Không tìm sản phẩm!');
        }
        $mergedList = mergeImageWithList($product->image, $product->image_list);
        if ($product) {
            $view = 1;
            $product->views += $view;
            $product->save();
        }
        $details = null;
        if (!is_null($product->details) && $this->isValidJson($product->details)) {
            $details = json_decode($product->details, true);
        }
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->isActive()
            ->take(8)
            ->get();
        return view('clients.product.detail', compact('product', 'mergedList', 'details', 'relatedProducts'));
    }
    private function isValidJson($string)
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
    public function showInfo(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $mergedList = mergeImageWithList($product->image, $product->image_list);

        return view('clients.partials.product-view-box', ['product' => $product, 'mergedList' => $mergedList]);
    }
    public function getVariationInfo(Request $request)
    {
        $variationKey = "";
        foreach ($request->variation_id as $variationId) {
            $fieldName      = 'variation_value_for_variation_' . $variationId;
            $variationKey  .=  $variationId . ':' . $request[$fieldName] . '/';
        }
        $productVariation = ProductVariation::where('variation_key', $variationKey)->where('product_id', $request->product_id)->first();

        return new ProductVariationInfoResource($productVariation);
    }
}
