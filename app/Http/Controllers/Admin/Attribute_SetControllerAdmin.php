<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeSetsRequestAdmin;
use App\Models\Attribute;
use App\Models\AttributeSet;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class Attribute_SetControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $attribute = AttributeSet::select(['id', 'name']);

            $data = DataTables::of($attribute)
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
                    $childrenCount = Attribute::where('attribute_set_id', $row->id)->count();
                    return $childrenCount;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.attributes_sets.parent', $row->id) . '" class="me-2 btn btn-sm btn-primary">Xem thuộc tính</a>'
                        . '<a href="' . route('admin.attributes_sets.editAttribute_Set', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.attributes_sets.deleteAttribute_Set', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        return view('admin.attributes-sets.index');
    }
    public function parent(Request $request, $id)
    {
        $super = AttributeSet::find($id);
        if (!$super) {
            return redirect(route('admin.attributes_sets.index'))->withErrorMessage('Không tìm thấy nhóm thuộc tính.');
        }
        request()->session()->put('parent_attributes', $super->id);
        if ($request->isMethod('post')) {

            $attribute = Attribute::with('attributeSet')->select(['id', 'name', 'attribute_set_id', 'status'])
                ->where('attribute_set_id', $id);

            $data = DataTables::of($attribute)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhereHas('attributeSet', function ($subQuery) use ($search) {
                                    $subQuery->where('name', 'like', "%{$search}%");
                                })
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.attributes.editAttribute', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.attributes.deleteAttribute', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);

            return $data;
        }
        return view('admin.attributes-sets.parent', compact('super'));
    }
    public function add()
    {
        request()->session()->forget('uploadImages');
        return view('admin.attributes-sets.add',);
    }
    public function postAdd(AttributeSetsRequestAdmin $request)
    {
        try {
            $slug = generateSlug($request->name, 'attributeset');
            $addAttributeSet = AttributeSet::create([
                'name' => $request->input('name'),
                'slug' => $slug,
            ]);

            return redirect(route('admin.attributes_sets.index'))->withSuccessMessage('Thêm nhóm thuộc tính thành công!');
        } catch (\Exception $e) {
            return redirect(route('admin.attributes_sets.addAttribute_Set'))->withErrorMessage('Đã xảy ra lỗi khi thêm nhóm thuộc tính.');
        }
    }
    public function edit($id)
    {
        $data = AttributeSet::find($id);
        if (!$data) {
            return redirect(route('admin.attributes_sets.index'))->withErrorMessage('Không tìm thấy nhóm thuộc tính game.');
        }
        if ($data->id == AttributeSet::defaultAttributeSet()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa nhóm thuộc tính này.');
        }
        $attribute = AttributeSet::select('name', 'id')->get();
        $validator = JsValidatorFacade::formRequest(
            'App\Http\Requests\Admin\AttributeSetsRequestAdmin',
            '#form-validate'
        );
        return view('admin.attributes-sets.edit', compact('data'));
    }

    public function postEdit(AttributeSetsRequestAdmin $request, $id)
    {
        $data = AttributeSet::find($id);
        if (!$data) {
            return redirect(route('admin.attributes_sets.index'))->withErrorMessage('Không tìm thấy nhóm thuộc tính game.');
        }
        if ($data->id == AttributeSet::defaultAttributeSet()->id) {
            return redirect()->back()->withErrorMessage('Không thể sửa nhóm thuộc tính này.');
        }
        try {

            $data->update([
                'name' => $request->input('name'),
            ]);
            return redirect(route('admin.attributes_sets.index'))->withSuccessMessage('Cập nhật nhóm thuộc tính thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.attributes_sets.editAttribute_Set', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật nhóm thuộc tính.');
        }
    }
    public function delete()
    {
        $id = request()->id;
        $attribute = AttributeSet::find($id);

        if ($attribute == NULL) {
            return redirect(route('admin.attributes_sets.index'))->withErrorMessage('Không tìm thấy nhóm thuộc tính.');
        } else {
            if ($attribute->id == AttributeSet::defaultAttributeSet()->id) {
                return redirect()->back()->withErrorMessage('Không thể xoá nhóm thuộc tính này.');
            }
            $attribute->delete();
            return redirect(route('admin.attributes_sets.index'))->withSuccessMessage('Xoá nhóm thuộc tính thành công');
        }
    }
}
