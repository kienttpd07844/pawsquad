<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandsRequestAdmin;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandsControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $brands = Brand::select(['id', 'name', 'status', 'logo']);

            $data = DataTables::of($brands)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.brands.editBrands', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.brands.deleteBrands', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        request()->session()->forget('uploadImages');
        return view('admin.brands.index');
    }
    public function trashed(Request $request)
    {
        if ($request->isMethod('post')) {
            $brands = Brand::onlyTrashed()->select(['id', 'name', 'status', 'logo']);

            $data = DataTables::of($brands)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.brands.editBrands', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.brands.restoreBrands', $row->id) . '" class="btn btn-sm btn-success restore-btn" data-id="' . $row->id . '">Khôi phục</a>'
                        . ' <a href="' . route('admin.brands.deleteBrands', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })

                ->make(true);
            return $data;
        }
        request()->session()->forget('uploadImages');
        return view('admin.brands.trashed');
    }
    public function add()
    {
        request()->session()->forget('uploadImages');
        return view('admin.brands.add');
    }
    public function postAdd(BrandsRequestAdmin $request)
    {
        if (session()->has('uploadImages')) {
            $status = $request->status == 'on' ? 1 : 0;
            $slug = generateSlug($request->slug, 'brand');
            $uploadImages = session('uploadImages');
            foreach ($uploadImages as $image) {
                if ($image['type'] === 'avatar') {
                    $image['image'] = decrypt($image['image']);
                    $avatar = $image['image'];
                }
            }
            if (!$avatar) {
                return redirect(route('admin.brands.addBrands'))->withErrorMessage('Vui lòng upload hình ảnh!');
            }
            try {
                $addBrand = Brand::create([
                    'logo' => $avatar,
                    'name' => $request->input('name'),
                    'slug' => $slug,
                    'status' => $status,
                    'description' => $request->input('description'),
                    'meta_title' => $request->input('meta_title') ?? NULL,
                    'meta_description' => $request->input('meta_description') ?? NULL,
                ]);
                return redirect(route('admin.brands.index'))->withSuccessMessage('Thêm nhãn hàng thành công!');
            } catch (\Exception $e) {
                return redirect(route('admin.brands.addBrands'))->withErrorMessage('Đã xảy ra lỗi khi thêm nhãn hàng.');
            }
        } else {
            return redirect(route('admin.brands.addBrands'))->withErrorMessage('Vui lòng upload hình ảnh!');
        }
    }
    public function edit($id)
    {
        $data = Brand::find($id);
        if (!$data) {
            return redirect(route('admin.brands.index'))->withErrorMessage('Không tìm thấy nhãn hàng.');
        }
        if ($data->id == Brand::defaultBrand()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa nhãn hàng này.');
        }
        request()->session()->put('brand', [
            'id' => encrypt($id),
            'image' => encrypt($data->logo),
        ]);
        request()->session()->forget('uploadImages');
        return view('admin.brands.edit', compact('data'));
    }

    public function postEdit(BrandsRequestAdmin $request, $id)
    {
        $data = Brand::find($id);
        if (!$data) {
            return redirect(route('admin.brand.index'))->withErrorMessage('Không tìm thấy nhãn hàng.');
        }
        if ($data->id == Brand::defaultBrand()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa nhãn hàng này.');
        }
        $uploadImage = session('uploadImages');
        $brandImage = session('brand.image');
        if (request()->session()->has('uploadImages')) {
            $image = decrypt($uploadImage[0]['image']);
        } else {
            $image = decrypt($brandImage);
        }
        if (!$image) {
            return redirect()->back()->withErrorMessage('Vui lòng tải ảnh lên.');
        }
        try {
            $slug = generateSlug($request->slug, 'brand', $data->id);
            $status = $request->status == 'on' ? 1 : 0;
            $data->update([
                'logo' => $image,
                'name' => $request->input('name'),
                'slug' => $slug,
                'status' => $status,
                'description' => $request->input('description'),
                'meta_title' => $request->input('meta_title') ?? NULL,
                'meta_description' => $request->input('meta_description') ?? NULL,
            ]);
            return redirect(route('admin.brands.index'))->withSuccessMessage('Cập nhật nhãn hàng thành công!');
        } catch (\Exception $e) {
            return redirect(route('admin.brands.editBrands', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật nhãn hàng.');
        }
    }
    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if ($brand->id == Brand::defaultBrand()->id) {
            return redirect()->back()->withErrorMessage('Không thể khôi phục nhãn hàng này.');
        }
        if (!$brand) {
            return redirect()->route('admin.brands.index')->withErrorMessage('Nhãn hàng không tìm thấy.');
        }
        $brand->restore();
        return redirect()->route('admin.brands.index')->withSuccessMessage('Khôi phục nhãn hàng thành công.');
    }

    public function delete()
    {
        $id = request()->id;
        $brand = Brand::withTrashed()->find($id);

        if ($brand == NULL) {
            return redirect(route('admin.brands.index'))->withErrorMessage('Không tìm thấy nhãn hàng.');
        }
        if ($brand->id == Brand::defaultBrand()->id) {
            return redirect()->back()->withErrorMessage('Không thể xoá nhãn hàng này.');
        }
        if ($brand->deleted_at) {
            if ($brand->logo) {
                deleteImages($brand->logo);
            }
            $brand->forceDelete();
            return redirect(route('admin.brands.index'))->withSuccessMessage('Đã xóa hoàn toàn nhãn hàng.');
        } else {
            $brand->delete();
            return redirect(route('admin.brands.index'))->withSuccessMessage('Đã xóa nhãn hàng, có thể khôi phục.');
        }
    }
}
