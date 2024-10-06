<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariationsRequestAdmin;
use App\Models\Variations;
use App\Models\VariationValues;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VariationsControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $variations = Variations::select(['id', 'name', 'status']);

            $data = DataTables::of($variations)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('children_count', function ($row) {
                    $childrenCount = VariationValues::where('variation_id', $row->id)->count();
                    return $childrenCount;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.variations.parent', $row->id) . '" class="me-2 btn btn-sm btn-primary">Xem nhóm</a>'
                        . '<a href="' . route('admin.variations.editVariations', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.variations.deleteVariations', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        request()->session()->forget('parent_variations');
        return view('admin.variations.index');
    }
    public function add()
    {
        $variantions = Variations::select('name', 'id')->get();
        return view('admin.variations.add');
    }
    public function postAdd(VariationsRequestAdmin $request)
    {
        $status = $request->status == 'on' ? 1 : 0;
        try {
            $addVariations = Variations::create([
                'name' => $request->input('name'),
                'status' => $status,
            ]);
            return redirect(route('admin.variations.index'))->withSuccessMessage('Thêm biến thể thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.variations.addVariations'))->withErrorMessage('Đã xảy ra lỗi khi thêm biến thể.');
        }
    }
    public function parent(Request $request, $id)
    {
        $super = Variations::find($id);
        if (!$super) {
            return redirect(route('admin.variantions.index'))->withErrorMessage('Không tìm thấy biến thể con.');
        }
        request()->session()->put('parent_variations', $super->id);
        if ($request->isMethod('post')) {
            $variationValues = VariationValues::select(['id', 'name', 'status'])->where('variation_id',$id);

            $data = DataTables::of($variationValues)
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
                    return '<a href="' . route('admin.variations.editVariations', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.variations.deleteVariations', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        return view('admin.variations.parent', compact('super'));
    }
    public function edit($id)
    {
        $data = Variations::find($id);
        if (!$data) {
            return redirect(route('admin.variations.index'))->withErrorMessage('Không tìm thấy biến thể.');
        }
        if ($data->id == Variations::defaultVariations()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa biến thể này.');
        }
        return view('admin.variations.edit', compact( 'data'));
    }

    public function postEdit(VariationsRequestAdmin $request, $id)
    {
        $data = Variations::find($id);
        if (!$data) {
            return redirect(route('admin.variations.index'))->withErrorMessage('Không tìm thấy biến thể.');
        }
        if ($data->id == Variations::defaultVariations()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa biến thể này.');
        }
        try {
            $status = $request->status == 'on' ? 1 : 0;
            $data->update([
                'name' => $request->input('name'),
                'status' => $status,
            ]);
            return redirect(route('admin.variations.index'))->withSuccessMessage('Cập nhật biến thể thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.variations.editVariations', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật biến thể.');
        }
    }
    public function delete()
    {
        $id = request()->id;
        $variations = Variations::find($id);

        if ($variations == NULL) {
            return redirect(route('admin.variations.index'))->withErrorMessage('Không tìm thấy biến thể.');
        }
        if ($variations->id == Variations::defaultVariations()->id) {
            return redirect()->back()->withErrorMessage('Không thể xoá biến thể này.');
        }
        if ($variations->deleted_at) {
            $variations->forceDelete();
            return redirect(route('admin.variations.index'))->withSuccessMessage('Đã xóa hoàn toàn biến thể sản phẩm.');
        } else {
            $variations->delete();
            return redirect(route('admin.variations.index'))->withSuccessMessage('Đã xóa biến thể sản phẩm, có thể khôi phục.');
        }
    }
    public function trashed(Request $request)
    {
        if ($request->isMethod('post')) {
            $categories = Variations::onlyTrashed()->select(['id', 'name', 'status']);

            $data = DataTables::of($categories)
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
                    return '<a href="' . route('admin.variations.restoreVariations', $row->id) . '" class="me-2 btn btn-sm btn-primary">Khôi phục</a>'
                        . '<a href="' . route('admin.variations.editVariations', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.variations.deleteVariations', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        request()->session()->forget('parent_variations');
        return view('admin.variations.trashed');
    }
    public function restore($id)
    {
        $variations = Variations::onlyTrashed()->find($id);
        if ($variations->id == Variations::defaultVariations()->id) {
            return redirect()->back()->withErrorMessage('Không thể khôi phục biến thể sản phẩm này.');
        }
        if (!$variations) {
            return redirect()->route('admin.variations.index')->withErrorMessage('biến thể sản phẩm không tìm thấy.');
        }
        $variations->restore();
        return redirect()->route('admin.variations.index')->withSuccessMessage('Khôi phục biến thể sản phẩm thành công.');
    }
}
