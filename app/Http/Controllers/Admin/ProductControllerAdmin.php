<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequestAdmin;
use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationCombination;
use App\Models\ProductVariationStock;
use App\Models\Variations;
use App\Models\VariationValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use Yajra\DataTables\Facades\DataTables;

class ProductControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $product = Product::with('category', 'brand')
                ->select(['id', 'min_price', 'max_price', 'name', 'status', 'brand_id', 'category_id', 'image', 'views']);

            $data = DataTables::of($product)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            if (strpos($search, '#') === 0) {
                                $idSearch = ltrim($search, '#'); // Loại bỏ dấu #
                                $q->where('id', $idSearch);
                            } else {
                                // Lọc theo id, name, views
                                $q->where('id', $search)
                                    ->orWhereRaw('LOWER(name) = ?', [strtolower($search)])
                                    ->orWhere('views', $search);
                                if (is_numeric($search)) {
                                    $q->orWhere('min_price', $search)
                                        ->orWhere('max_price', $search);
                                }
                                if (strtolower($search) == 'nháp') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 0);
                                    });
                                } elseif (strtolower($search) == 'hiện' || strtolower($search) == 'công khai') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 1);
                                    });
                                } elseif (strtolower($search) == 'ẩn') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 2);
                                    });
                                }

                                // Lọc theo category nếu không tìm theo trạng thái
                                if (!in_array(strtolower($search), ['nháp', 'hiện', 'công khai', 'ẩn'])) {
                                    $q->orWhereHas('category', function ($query) use ($search) {
                                        $query->where('name', 'like', "%{$search}%");
                                    });
                                }
                            }
                        });
                    }
                })
                ->addColumn('price_custom', function ($row) {
                    if ($row->max_price != $row->min_price) {
                        return format_cash($row->min_price) . ' - ' . format_cash($row->max_price);
                    } else {
                        return format_cash($row->min_price);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.products.editProduct', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.products.deleteProduct', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);

            return $data;
        }

        request()->session()->forget('uploadImages');
        return view('admin.products.index');
    }

    public function add()
    {
        $categories = Category::select('name', 'id')
            ->where(function ($query) {
                $query->where('parent_id', '!=', 0)
                    ->whereNotNull('parent_id');
            })
            ->get();
        $brands = Brand::select('name', 'id')
            ->where(function ($query) {
                $query->where('slug', '!=', 'uncategorized');
            })
            ->get();
        $variations = Variations::isActive()->where('id', '!=', 1)->get();
        request()->session()->forget('uploadImages');
        return view('admin.products.add', compact('categories', 'brands', 'variations'));
    }
    public function postAdd(ProductRequestAdmin $request)
    {
        if (!Category::where('id', $request->category)
            ->whereNotNull('parent_id')
            ->where('parent_id', '!=', 0)
            ->exists()) {
            throw ValidationException::withMessages([
                'attributeset' => 'Danh mục không hợp lệ.',
            ]);
        }
        if ($request->has('brands') && !Brand::where('id', $request->brands)
            ->where('id', '!=', 1)
            ->exists()) {
            throw ValidationException::withMessages([
                'attributeset' => 'Nhãn hàng không hợp lệ.',
            ]);
        }
        if ($request->has('is_variant') && !$request->has('variations')) {
            return redirect()->back()->withErrorMessage('Không tìm thấy biến thể, vui lòng thử lại!');
        }
        if (!$request->has('variations') && !$request->has('is_variant')) {
            // Thêm các quy tắc xác thực bổ sung
            $request->validate([
                'price' => 'required|numeric|min:0',
                'old_price' => 'nullable|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'code' => 'required|string|max:255',
            ], [
                'price.required' => 'Giá sản phẩm là bắt buộc cho sản phẩm có biến thể.',
                'price.numeric' => 'Giá sản phẩm phải là số.',
                'old_price.numeric' => 'Giá cũ phải là số.',
                'stock.required' => 'Số lượng tồn kho là bắt buộc.',
                'code.required' => 'Mã sản phẩm là bắt buộc.',
            ]);
        }
        DB::beginTransaction();
        $slug = generateSlug($request->slug, 'product');
        $values = $request->values;
        $result = [];

        if ($request->has('values') && is_array($request->values)) {
            foreach ($values as $value) {
                preg_match('/(\d+)@(\d+): \{ "([^"]+)"\s*:\s*"([^"]+)" \}/', $value, $matches);
                if (count($matches) === 5) {
                    $attributeset = $matches[1];
                    $attributeId = $matches[2];
                    $attributeName = $matches[3];
                    $attributeValue = $matches[4];
                    $attribute = Attribute::where('id', $attributeId)->first();

                    if ($attribute) {
                        $existingValues = json_decode($attribute->value, true) ?? [];
                        $existingValuesFlat = array_column($existingValues, 'value');
                        if (!in_array($attributeValue, $existingValuesFlat)) {
                            $existingValues[] = [
                                'id' => null,
                                'value' => $attributeValue,
                            ];
                            $attribute->value = json_encode($existingValues);
                            $attribute->save();
                        }

                        if (!isset($result[$attributeset])) {
                            $result[$attributeset] = [];
                        }

                        $existingAttributeKey = null;
                        foreach ($result[$attributeset] as $key => $existingAttribute) {
                            if ($existingAttribute['attribute'] == $attributeId) {
                                $existingAttributeKey = $key;
                                break;
                            }
                        }

                        if ($existingAttributeKey !== null) {
                            $result[$attributeset][$existingAttributeKey]['value'][] = [
                                'id' => null,
                                'value' => $attributeValue,
                            ];
                        } else {
                            $result[$attributeset][] = [
                                'attributeset' => (int)$attributeset,
                                'name' => $attributeName,
                                'attribute' => (int)$attributeId,
                                'value' => [
                                    [
                                        'id' => null,
                                        'value' => $attributeValue,
                                    ]
                                ],
                            ];
                        }
                    } else {
                        redirect()->back()->withErrorMessage('Đã xảy ra lỗi khi thêm thuộc tính.');
                    }
                } else {
                    redirect()->back()->withErrorMessage('Đã xảy ra lỗi khi thêm thuộc tính 1.');
                }
            }
        }
        if (session()->has('uploadImages') && !empty(session('uploadImages'))) {
            $uploadImages = session('uploadImages');
            $detailImages = [];
            foreach ($uploadImages as $image) {
                if ($image['type'] === 'avatar') {
                    $image['image'] = decrypt($image['image']);
                    $avatar = $image['image']; // ảnh đại diện - lưu vào trường IMAGE
                } elseif ($image['type'] === 'detail') {
                    $decryptedImage = decrypt($image['image']); // Giải mã và lưu giá trị vào biến trường gian
                    $image['listimg'] = [$decryptedImage]; // Chuyển đổi thành mảng của ảnh
                    unset($image['image']); // Xóa trường image
                    $detailImages[] = $image['listimg'];
                }
            }
            if (!empty($detailImages)) {
                $image_list = json_encode($detailImages);
            }
        }
        if ($request->has('is_variant') && $request->has('variations')) {
            $min_price =  min(array_column($request->variations, 'price'));
            $max_price =  max(array_column($request->variations, 'price'));
        } else {
            $min_price =  $request->price;
            $max_price =  $request->price;
        }
        try {
            $product = Product::create([
                'name' => $request->input('name'),
                'slug' => $slug,
                'old_price' => $request->old_price ?? 0,
                'stock_qty' => $request->stock,
                'price' => 0,
                'min_price' => $min_price,
                'max_price' => $max_price,
                'image' => $avatar ?? NULL,
                'image_list' => $image_list ?? NULL,
                'category_id' => $request->category,
                'brand_id' => $request->brands ?? NULL,
                'status' => $request->status,
                'featured' => $request->featured,
                'has_variation' => ($request->has('is_variant') && $request->has('variations')) ? 1 : 0,
                'details' => $request->input('values') ? json_encode($result) : NULL,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'meta_title' => $request->input('meta_title') ?? NULL,
                'meta_description' => $request->input('meta_description') ?? NULL,
                'views' => 0,
            ]);
            if ($request->has('is_variant') && $request->has('variations')) {
                foreach ($request->variations as $variation) {
                    $product_variation              = new ProductVariation;
                    $product_variation->product_id  = $product->id;
                    $product_variation->variation_key     = $variation['variation_key'];
                    $product_variation->price       = $variation['price'];
                    $product_variation->code         = $variation['code'];
                    $product_variation->save();
                    $product_variation_stock                              = new ProductVariationStock;
                    $product_variation_stock->product_variation_id        = $product_variation->id;
                    $product_variation_stock->stock_qty                   = $variation['stock'];
                    $product_variation_stock->save();
                    foreach (array_filter(explode("/", $variation['variation_key'])) as $combination) {
                        $product_variation_combination                         = new ProductVariationCombination;
                        $product_variation_combination->product_id             = $product->id;
                        $product_variation_combination->product_variation_id   = $product_variation->id;
                        $product_variation_combination->variation_id           = explode(":", $combination)[0];
                        $product_variation_combination->variation_value_id     = explode(":", $combination)[1];
                        $product_variation_combination->save();
                    }
                }
            } else {
                $variation              = new ProductVariation;
                $variation->product_id  = $product->id;
                $variation->code         = $request->code;
                $variation->price       = $request->price;
                $variation->save();
                $product_variation_stock                          = new ProductVariationStock;
                $product_variation_stock->product_variation_id    = $variation->id;
                $product_variation_stock->stock_qty               = $request->stock;
                $product_variation_stock->save();
            }
            DB::commit();
            return redirect(route('admin.products.index'))->withSuccessMessage('Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect(route('admin.products.addProduct'))->withErrorMessage('Đã xảy ra lỗi khi thêm sản phẩm.');
        }
    }
    public function edit($id)
    {
        $data = Product::find($id);
        if (!$data) {
            return redirect(route('admin.products.index'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
        $categories = Category::select('name', 'id')
            ->where(function ($query) {
                $query->where('parent_id', '!=', 0)
                    ->whereNotNull('parent_id');
            })
            ->get();
        $brands = Brand::select('name', 'id')
            ->where(function ($query) {
                $query->where('slug', '!=', 'uncategorized');
            })
            ->get();
        $variations = Variations::isActive()->where('id', '!=', 1)->get();
        request()->session()->put('product', [
            'id' => encrypt($id),
            'image' => isset($data->image) ? encrypt($data->image) : '',
            'listimg' => isset($data->image_list) ? json_decode($data->image_list) : '',
        ]);
        request()->session()->forget('uploadImages');
        return view('admin.products.edit', compact('categories', 'brands', 'variations', 'data'));
    }

    public function postEdit(ProductRequestAdmin $request, $id)
    {
        $data = Product::find($id);
        if (!$data) {
            return redirect(route('admin.products.index'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
        if (!Category::where('id', $request->category)
            ->whereNotNull('parent_id')
            ->where('parent_id', '!=', 0)
            ->exists()) {
            throw ValidationException::withMessages([
                'attributeset' => 'Danh mục không hợp lệ.',
            ]);
        }
        if ($request->has('brands') && !Brand::where('id', $request->brands)
            ->where('id', '!=', 1)
            ->exists()) {
            throw ValidationException::withMessages([
                'attributeset' => 'Nhãn hàng không hợp lệ.',
            ]);
        }
        if ($request->has('is_variant') && !$request->has('variations')) {
            return redirect()->back()->withErrorMessage('Không tìm thấy biến thể, vui lòng thử lại!');
        }

        try {
            DB::transaction(function () use ($request, $id) {
                $productData  = Product::where('id', $id)->first();
                $oldProduct  = clone $productData;
                if ($request->has('is_variant') && $request->has('variations')) {
                    $min_price =  (min(array_column($request->variations, 'price')));
                    $max_price =  (max(array_column($request->variations, 'price')));
                } else {
                    $min_price =  ($request->price);
                    $max_price =  ($request->price);
                }
                $slug = generateSlug($request->slug, 'product', $productData->id);
                $values = $request->values;
                $result = [];

                if ($request->has('values') && is_array($request->values)) {
                    foreach ($values as $value) {
                        preg_match('/(\d+)@(\d+): \{ "([^"]+)"\s*:\s*"([^"]+)" \}/', $value, $matches);
                        if (count($matches) === 5) {
                            $attributeset = $matches[1];
                            $attributeId = $matches[2];
                            $attributeName = $matches[3];
                            $attributeValue = $matches[4];
                            $attribute = Attribute::where('id', $attributeId)->first();

                            if ($attribute) {
                                $existingValues = json_decode($attribute->value, true) ?? [];
                                $existingValuesFlat = array_column($existingValues, 'value');
                                if (!in_array($attributeValue, $existingValuesFlat)) {
                                    $existingValues[] = [
                                        'id' => null,
                                        'value' => $attributeValue,
                                    ];
                                    $attribute->value = json_encode($existingValues);
                                    $attribute->save();
                                }

                                if (!isset($result[$attributeset])) {
                                    $result[$attributeset] = [];
                                }

                                $existingAttributeKey = null;
                                foreach ($result[$attributeset] as $key => $existingAttribute) {
                                    if ($existingAttribute['attribute'] == $attributeId) {
                                        $existingAttributeKey = $key;
                                        break;
                                    }
                                }

                                if ($existingAttributeKey !== null) {
                                    $result[$attributeset][$existingAttributeKey]['value'][] = [
                                        'id' => null,
                                        'value' => $attributeValue,
                                    ];
                                } else {
                                    $result[$attributeset][] = [
                                        'attributeset' => (int)$attributeset,
                                        'name' => $attributeName,
                                        'attribute' => (int)$attributeId,
                                        'value' => [
                                            [
                                                'id' => null,
                                                'value' => $attributeValue,
                                            ]
                                        ],
                                    ];
                                }
                            } else {
                                redirect()->back()->withErrorMessage('Đã xảy ra lỗi khi thêm thuộc tính.');
                            }
                        } else {
                            redirect()->back()->withErrorMessage('Đã xảy ra lỗi khi thêm thuộc tính 1.');
                        }
                    }
                }
                if (session()->has('uploadImages')) {
                    $uploadImages = session('uploadImages');
                    $detailImages = [];
                    if ($uploadImages) {
                        foreach ($uploadImages as $key => $image) {
                            $image = str_replace('public/', '', decrypt($image['image']));
                            $filePath = public_path($image);
                            if (!file_exists($filePath)) {
                                unset($uploadImages[$key]);
                            }
                        }
                        session(['uploadImages' => $uploadImages]);
                        foreach ($uploadImages as $image) {
                            if ($image['type'] == 'avatar') {
                                $image['image'] = decrypt($image['image']);
                                $avatara = $image['image']; // ảnh đại diện - lưu vào trường IMAGE
                            } elseif ($image['type'] == 'detail') {
                                $decryptedImage = decrypt($image['image']); // Giải mã và lưu giá trị vào biến trường gian
                                $image['listimg'] = [$decryptedImage]; // Chuyển đổi thành mảng của ảnh
                                unset($image['image']); // Xóa trường image
                                $detailImages[] = $image['listimg'];
                            }
                        }
                    }

                    $dataListIMG = $productData->image_list;
                    if ($dataListIMG) {
                        $image_json_decode = json_decode($dataListIMG);
                        $mergedIMG = array_merge($image_json_decode, $detailImages);
                        $image_list = json_encode($mergedIMG);
                    } else {
                        $image_list = json_encode($detailImages);
                    }
                    if (isset($avatara)) {
                        $avatar = $avatara;
                    } else {
                        $avatar = $productData->image;
                    }
                } else {
                    $product = session('product');
                    $avatar = decrypt($product['image']);
                    $detailImages = $product['listimg'];
                    $image_list = json_encode($detailImages);
                }
                $productData->update([
                    'name' => $request->input('name'),
                    'slug' => $slug,
                    'old_price' => $request->old_price ?? 0,
                    'price' => 0,
                    'min_price' => $min_price,
                    'max_price' => $max_price,
                    'stock_qty' => $request->stock,
                    'image' => $avatar ?? NULL,
                    'image_list' => $image_list ?? NULL,
                    'category_id' => $request->category,
                    'brand_id' => $request->brands ?? NULL,
                    'status' => $request->status,
                    'featured' => $request->featured,
                    'has_variation' => ($request->has('is_variant') && $request->has('variations')) ? 1 : 0,
                    'details' => $request->input('values') ? json_encode($result) : NULL,
                    'description' => $request->description,
                    'short_description' => $request->short_description,
                    'meta_title' => $request->input('meta_title') ?? NULL,
                    'meta_description' => $request->input('meta_description') ?? NULL,
                    'views' => 0,
                ]);
                if ($request->has('is_variant') && $request->has('variations')) {
                    $new_requested_variations = collect($request->variations);
                    $new_requested_variations_key = $new_requested_variations->pluck('variation_key')->toArray();
                    $old_variations_keys = $productData->variations->pluck('variation_key')->toArray();
                    $old_matched_variations = $new_requested_variations->whereIn('variation_key', $old_variations_keys);
                    $new_variations = $new_requested_variations->whereNotIn('variation_key', $old_variations_keys);

                    # xóa các biến thể cũ không được yêu cầu
                    $productData->variations->whereNotIn('variation_key', $new_requested_variations_key)->each(function ($variation) {
                        foreach ($variation->combinations as $comb) {
                            $comb->delete();
                        }
                        $variation->delete();
                    });


                    # cập nhật các biến thể để khớp cũ
                    foreach ($old_matched_variations as $variation) {
                        $p_variation              = ProductVariation::where('product_id', $productData->id)->where('variation_key', $variation['variation_key'])->first();
                        $p_variation->price       = $variation['price'];
                        $p_variation->code         = $variation['code'];
                        $p_variation->save();

                        # cập nhật kho của biến thể
                        $productVariationStock = $p_variation->product_variation_stock_without_location()->first();

                        if (is_null($productVariationStock)) {
                            $productVariationStock = new ProductVariationStock;
                            $productVariationStock->product_variation_id = $p_variation->id;
                        }
                        $productVariationStock->stock_qty = $variation['stock'];
                        $productVariationStock->save();
                    }

                    # lưu trữ các biến thể mới được yêu cầu
                    foreach ($new_variations as $variation) {
                        $product_variation                      = new ProductVariation;
                        $product_variation->product_id          = $productData->id;
                        $product_variation->variation_key       = $variation['variation_key'];
                        $product_variation->price               = $variation['price'];
                        $product_variation->code                 = $variation['code'];
                        $product_variation->save();

                        $product_variation_stock                              = new ProductVariationStock;
                        $product_variation_stock->product_variation_id        = $product_variation->id;
                        $product_variation_stock->stock_qty                   = $variation['stock'];
                        $product_variation_stock->save();

                        foreach (array_filter(explode("/", $variation['variation_key'])) as $combination) {
                            $product_variation_combination                         = new ProductVariationCombination;
                            $product_variation_combination->product_id             = $productData->id;
                            $product_variation_combination->product_variation_id   = $product_variation->id;
                            $product_variation_combination->variation_id           = explode(":", $combination)[0];
                            $product_variation_combination->variation_value_id     = explode(":", $combination)[1];
                            $product_variation_combination->save();
                        }
                    }
                } else {
                    # kiểm tra xem sản phẩm cũ có phải là biến thể không, sau đó xóa tất cả các biến thể và kết hợp cũ
                    if ($oldProduct->is_variant) {
                        foreach ($productData->variations as $variation) {
                            foreach ($variation->combinations as $comb) {
                                $comb->delete();
                            }
                            $variation->delete();
                        }
                    }

                    $variation                       = $productData->variations->first();
                    $variation->product_id           = $productData->id;
                    $variation->variation_key        = null;
                    $variation->code                  = $request->code;
                    $variation->price                = $request->price;
                    $variation->save();


                    if ($variation->product_variation_stock) {
                        $productVariationStock = $variation->product_variation_stock_without_location()->first();

                        if (is_null($productVariationStock)) {
                            $productVariationStock = new ProductVariationStock;
                        }
                        $productVariationStock->product_variation_id = $variation->id;
                        $productVariationStock->stock_qty = $request->stock;
                        $productVariationStock->save();
                    } else {
                        $product_variation_stock                          = new ProductVariationStock;
                        $product_variation_stock->product_variation_id    = $variation->id;
                        $product_variation_stock->stock_qty               = $request->stock;
                        $product_variation_stock->save();
                    }
                }
            });
            return redirect(route('admin.products.index'))->withSuccessMessage('Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.products.editProduct', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật sản phẩm.');
        }
    }
    public function delete()
    {
        $id = request()->id;
        $product = Product::find($id);

        if ($product == NULL) {
            return redirect(route('admin.products.index'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
        $product->delete();
        return redirect(route('admin.products.index'))->withSuccessMessage('Đã xóa sản phẩm có thể khôi phục.');
    }
    public function trashed(Request $request)
    {
        if ($request->isMethod('post')) {
            $product = Product::onlyTrashed()->with('category', 'brand')
                ->select(['id', 'min_price', 'max_price', 'name', 'status', 'brand_id', 'category_id', 'image', 'views']);

            $data = DataTables::of($product)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            if (strpos($search, '#') === 0) {
                                $idSearch = ltrim($search, '#'); // Loại bỏ dấu #
                                $q->where('id', $idSearch);
                            } else {
                                // Lọc theo id, name, views
                                $q->where('id', $search)
                                    ->orWhereRaw('LOWER(name) = ?', [strtolower($search)])
                                    ->orWhere('views', $search);
                                if (is_numeric($search)) {
                                    $q->orWhere('min_price', $search)
                                        ->orWhere('max_price', $search);
                                }
                                if (strtolower($search) == 'nháp') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 0);
                                    });
                                } elseif (strtolower($search) == 'hiện' || strtolower($search) == 'công khai') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 1);
                                    });
                                } elseif (strtolower($search) == 'ẩn') {
                                    $q->orWhere(function ($subQuery) {
                                        $subQuery->where('status', 2);
                                    });
                                }

                                // Lọc theo category nếu không tìm theo trạng thái
                                if (!in_array(strtolower($search), ['nháp', 'hiện', 'công khai', 'ẩn'])) {
                                    $q->orWhereHas('category', function ($query) use ($search) {
                                        $query->where('name', 'like', "%{$search}%");
                                    });
                                }
                            }
                        });
                    }
                })
                ->addColumn('price_custom', function ($row) {
                    if ($row->max_price != $row->min_price) {
                        return format_cash($row->min_price) . ' - ' . format_cash($row->max_price);
                    } else {
                        return format_cash($row->min_price);
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.products.editProduct', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                    . ' <a href="' . route('admin.products.restoreProduct', $row->id) . '" class="btn btn-sm btn-success restore-btn" data-id="' . $row->id . '">Khôi phục</a>';
                })
                ->make(true);

            return $data;
        }
        request()->session()->forget('uploadImages');
        return view('admin.products.trashed');
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        if (!$product) {
            return redirect()->route('admin.products.index')->withErrorMessage('sản phẩm sản phẩm không tìm thấy.');
        }
        $product->restore();
        return redirect()->route('admin.products.index')->withSuccessMessage('Khôi phục sản phẩm thành công.');
    }

    public function getVariationValues(Request $request)
    {
        $variation_id = $request->variation_id;
        $variation_values = VariationValues::isActive()->where('variation_id', $variation_id)->get();
        return view('admin.partials.products.new_variation_values', compact('variation_values', 'variation_id'));
    }
    public function getNewVariation(Request $request)
    {
        $variations = Variations::where('id', '!=', 1);

        if ($request->has('chosen_variations')) {
            $variations = $variations->whereNotIn('id', $request->chosen_variations)->get();
        } else {
            $variations = $variations->get();
        }

        if ($variations->count() > 0) {
            return array(
                'count' => $variations->count(),
                'view' => view('admin.partials.products.new_variation', compact('variations'))->render(),
            );
        } else {
            return false;
        }
    }

    public function generateVariationCombinations(Request $request)
    {
        $variations_and_values = array();

        if ($request->has('chosen_variations')) {
            $chosen_variations = $request->chosen_variations;
            sort($chosen_variations, SORT_NUMERIC);

            foreach ($chosen_variations as $key => $option) {
                $option_name = 'option_' . $option . '_choices'; # $option = variation_id
                $value_ids = array();

                if ($request->has($option_name)) {

                    $variation_option_values = $request[$option_name];
                    sort($variation_option_values, SORT_NUMERIC);

                    foreach ($variation_option_values as $item) {
                        array_push($value_ids, $item);
                    }
                    $variations_and_values[$option] =  $value_ids;
                }
            }
        }

        $combinations = array(array());
        foreach ($variations_and_values as $variation => $variation_values) {
            $tempArray = array();
            foreach ($combinations as $combination_item) {
                foreach ($variation_values as $variation_value) {
                    $tempArray[] = $combination_item + array($variation => $variation_value);
                }
            }
            $combinations = $tempArray;
        }
        return view('admin.partials.products.new_variation_combinations', compact('combinations'))->render();
    }
    public function attribute()
    {
        $attribute = Attribute::select(['id', 'name', 'value', 'attribute_set_id'])
            ->where('status', 1)
            ->get();

        // Giải mã hoặc mã hóa value nếu cần thiết
        $attribute->transform(function ($item) {
            $item->value = json_decode($item->value); // Giải mã JSON để sử dụng trong frontend
            return $item;
        });

        return response()->json($attribute);
    }

    public function attributeset()
    {
        $attributeset = AttributeSet::select(['id', 'name'])->get();
        return response()->json($attributeset);
    }
    public function get_attribute_edit($id)
    {
        $productDetails = Product::findOrFail($id);
        // Phân tích dữ liệu JSON
        $productDetailsArray = json_decode($productDetails->details, true);

        // Lấy thuộc tính từ cơ sở dữ liệu và nhóm theo attribute_set_id
        $attributes = Attribute::select(['id', 'name', 'value', 'attribute_set_id'])
            ->where('status', 1)
            ->get()
            ->groupBy('attribute_set_id');
        $attributesets = AttributeSet::all()->pluck('name', 'id')->toArray();

        // Chuyển đổi dữ liệu thành mảng nhóm theo attribute_set_id
        $formattedAttributes = [];
        foreach ($attributes as $setId => $setAttributes) {
            foreach ($setAttributes as $attribute) {
                $valueArray = json_decode($attribute->value, true); // Giải mã dữ liệu JSON

                // Tạo cấu trúc dữ liệu với trường `is_selected` mặc định là false và thêm `id`
                $formattedAttributes[$setId][] = [
                    'name' => $attribute->name,
                    'attribute' => $attribute->id,
                    'value' => array_map(function ($item) use ($attribute) {
                        return [
                            'id' => $item['id'] === "null" ? null : $item['id'],
                            'value' => $item['value'],
                            'is_selected' => false
                        ];
                    }, $valueArray)
                ];
            }
        }

        // So sánh dữ liệu từ JSON với dữ liệu thuộc tính
        foreach ($formattedAttributes as $setId => &$details) {
            foreach ($details as &$attribute) {
                foreach ($attribute['value'] as &$item) {
                    // Chuyển đổi giá trị để so sánh
                    $itemValue = $item['value'];
                    $productDetailsForSet = isset($productDetailsArray[$setId]) ? $productDetailsArray[$setId] : [];
                    foreach ($productDetailsForSet as $productDetail) {
                        // Chuyển đổi productDetail thành chuỗi nếu đó là một mảng
                        $productDetailValues = isset($productDetail['value']) ? array_map(fn($val) => $val['value'], $productDetail['value']) : [];

                        if (in_array($itemValue, $productDetailValues)) {
                            $item['is_selected'] = true; // Đánh dấu là đã chọn
                        }
                    }
                }
            }
        }

        // Tạo cấu trúc dữ liệu theo định dạng mới với tên attributeset
        $result = [];
        foreach ($formattedAttributes as $setId => $attributes) {
            $result[] = [
                'attribute_set_id' => $setId,
                'attribute_set_name' => $attributesets[$setId] ?? 'Unknown', // Thêm tên attribute set
                'attributes' => $attributes
            ];
        }

        return response()->json($result);
    }
}
