<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequestAdmin;
use App\Models\Category;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CategoryControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $categories = Category::with('parent')->select(['id', 'name', 'status', 'image', 'parent_id', 'views'])
                ->where(function ($query) {
                    $query->where('parent_id', 0)
                        ->orWhereNull('parent_id');
                });

            $data = DataTables::of($categories)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhereHas('parent', function ($subQuery) use ($search) {
                                    $subQuery->where('name', 'like', "%{$search}%");
                                })
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('views', $search);
                        });
                    }
                })
                ->addColumn('children_count', function ($row) {
                    $childrenCount = Category::where('parent_id', $row->id)->count();
                    return $childrenCount;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.category.parent', $row->id) . '" class="me-2 btn btn-sm btn-primary">Xem nhóm</a>'
                        . '<a href="' . route('admin.category.editCategory', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.category.deleteCategory', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        request()->session()->forget('uploadImages');
        request()->session()->forget('parent_category');
        return view('admin.category.index');
    }
    public function add()
    {
        $categories = Category::select('name', 'id')->where(function ($query) {
            $query->where('parent_id', 0)
                ->orWhereNull('parent_id');
        })->get();
        $validator = JsValidatorFacade::formRequest(
            'App\Http\Requests\Admin\CategoryRequestAdmin',
            '#form-validate'
        );
        request()->session()->forget('uploadImages');
        return view('admin.category.add', compact('categories'));
    }
    public function postAdd(CategoryRequestAdmin $request)
    {
        if (session()->has('uploadImages')) {
            $status = $request->status == 'on' ? 1 : 0;
            $slug = generateSlug($request->name, 'category');
            $uploadImages = session('uploadImages');
            foreach ($uploadImages as $image) {
                if ($image['type'] === 'avatar') {
                    $image['image'] = decrypt($image['image']);
                    $avatar = $image['image'];
                }
            }
            try {
                $addCategory = Category::create([
                    'image' => $avatar,
                    'name' => $request->input('name'),
                    'slug' => $slug,
                    'parent_id' => isset($request->category) ? $request->category : NULL,
                    'status' => $status,
                    'description' => $request->input('description'),
                    'meta_title' => $request->input('meta_title') ?? NULL,
                    'meta_description' => $request->input('meta_description') ?? NULL,
                ]);
                return redirect(route('admin.category.index'))->withSuccessMessage('Thêm danh mục thành công!');
            } catch (\Exception $e) {
                dd($e);
                return redirect(route('admin.category.addCategory'))->withErrorMessage('Đã xảy ra lỗi khi thêm danh mục.');
            }
        } else {
            return redirect(route('admin.category.addCategory'))->withErrorMessage('Vui lòng upload hình ảnh!');
        }
    }
    public function parent(Request $request, $id)
    {
        $super = Category::find($id);
        if (!$super) {
            return redirect(route('admin.category.index'))->withErrorMessage('Không tìm thấy danh mục con.');
        }
        request()->session()->put('parent_category', $super->id);
        if ($request->isMethod('post')) {
            $categories = Category::with('products')->select(['id', 'name', 'status', 'image', 'parent_id', 'views'])
                ->where('parent_id', $id);

            $data = DataTables::of($categories)
                ->addColumn('products_count', function ($row) {
                    return $row->products()->count();
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.category.parent', $row->id) . '" class="me-2 btn btn-sm btn-primary">Xem sản phẩm</a>'
                        . '<a href="' . route('admin.category.editCategory', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.category.deleteCategory', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        request()->session()->forget('uploadImages');
        return view('admin.category.parent', compact('super'));
    }
    public function edit($id)
    {
        $data = Category::find($id);
        if (!$data) {
            return redirect(route('admin.category.index'))->withErrorMessage('Không tìm thấy danh mục game.');
        }
        if ($data->id == Category::defaultCategory()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa danh mục này.');
        }
        $categories = Category::select('name', 'id')->where(function ($query) {
            $query->where('parent_id', 0)
                ->orWhereNull('parent_id');
        })->get();
        $validator = JsValidatorFacade::formRequest(
            'App\Http\Requests\Admin\CategoryRequestAdmin',
            '#form-validate'
        );
        request()->session()->put('category', [
            'id' => encrypt($id),
            'image' => encrypt($data->image),
            'listimg' => NULL,
        ]);
        request()->session()->forget('uploadImages');
        return view('admin.category.edit', compact('categories', 'data'));
    }

    public function postEdit(CategoryRequestAdmin $request, $id)
    {
        $data = Category::find($id);
        if (!$data) {
            return redirect(route('admin.category.index'))->withErrorMessage('Không tìm thấy danh mục game.');
        }
        if ($data->id == Category::defaultCategory()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa danh mục này.');
        }
        $uploadImage = session('uploadImages');
        $categoryImage = session('category.image');
        if (request()->session()->has('uploadImages')) {
            $image = decrypt($uploadImage[0]['image']);
        } else {
            $image = decrypt($categoryImage);
        }
        if (!$image) {
            return redirect()->back()->withErrorMessage('Vui lòng tải ảnh lên.');
        }
        try {
            $status = $request->status == 'on' ? 1 : 0;
            $data->update([
                'image' => $image,
                'name' => $request->input('name'),
                'parent_id' => isset($request->category) ? $request->category : NULL,
                'status' => $status,
                'description' => $request->input('description'),
                'meta_title' => $request->input('meta_title') ?? NULL,
                'meta_description' => $request->input('meta_description') ?? NULL,
            ]);
            return redirect(route('admin.category.index'))->withSuccessMessage('Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.category.editCategory', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật danh mục.');
        }
    }
    public function delete()
    {
        $id = request()->id;
        $category = Category::find($id);

        if ($category == NULL) {
            return redirect(route('admin.category.index'))->withErrorMessage('Không tìm thấy danh mục.');
        } else {
            if ($category->id == Category::defaultCategory()->id) {
                return redirect()->back()->withErrorMessage('Không thể xoá danh mục này.');
            }
            if ($category->image) {
                deleteImages($category->image);
            }
            $category->delete();
            return redirect(route('admin.category.index'))->withSuccessMessage('Xoá danh mục thành công');
        }
    }
}
