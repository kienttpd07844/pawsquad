<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributesRequestAdmin;
use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AttributesControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $attribute = Attribute::with('attributeSet')->select(['id', 'name', 'attribute_set_id', 'status']);

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
                ->addColumn('attribute_set_name', function ($row) {
                    $attributeSet = AttributeSet::find($row->attribute_set_id);
                    return $attributeSet ? $attributeSet->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.attributes.editAttribute', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.attributes.deleteAttribute', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);
            return $data;
        }
        return view('admin.attributes.index');
    }

    public function add()
    {
        $attributeSet = AttributeSet::select('name', 'id')->where('slug', '!=', 'defaultattributeset')->get();
        $validator = JsValidatorFacade::formRequest(
            'App\Http\Requests\Admin\AttributesRequestAdmin',
            '#form-validate'
        );
        return view('admin.attributes.add', compact('validator', 'attributeSet'));
    }
    public function postAdd(AttributesRequestAdmin $request)
    {

        try {
            // Kiểm tra sự tồn tại của attribute set
            if (!AttributeSet::where('id', $request->attributeset)->exists()) {
                throw ValidationException::withMessages([
                    'attributeset' => 'Nhóm thuộc tính không hợp lệ.',
                ]);
            }

            $status = $request->status == 'on' ? 1 : 0;
            $slug = generateSlug($request->name, 'attribute');
            if ($request->has('values') && is_array($request->values)) {
                $value = json_encode($request->values);
            } else {
                throw ValidationException::withMessages([
                    'value' => 'Vui lòng nhập giá trị thuộc tính'
                ]);
            }


            $addAttribute = Attribute::create([
                'attribute_set_id' => $request->attributeset,
                'name' => $request->input('name'),
                'slug' => $slug,
                'value' => $value,
                'status' => $status
            ]);
            return redirect(route('admin.attributes.index'))->withSuccessMessage('Thêm thuộc tính thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.attributes.addAttribute'))->withErrorMessage('Đã xảy ra lỗi khi thêm thuộc tính.');
        }
    }
    public function edit($id)
    {
        $data = Attribute::find($id);
        if (!$data) {
            return redirect(route('admin.attributes.index'))->withErrorMessage('Không tìm thấy thuộc tính game.');
        }
        $attributeSet = AttributeSet::select('name', 'id')->where('slug', '!=', 'defaultattributeset')->get();
        return view('admin.attributes.edit', compact('data', 'attributeSet'));
    }

    public function postEdit(AttributesRequestAdmin $request, $id)
    {
        $data = Attribute::find($id);
        if (!$data) {
            return redirect(route('admin.attributes.index'))->withErrorMessage('Không tìm thấy thuộc tính game.');
        }
        try {
            // Kiểm tra sự tồn tại của attribute set
            if (!AttributeSet::where('id', $request->attributeset)->exists()) {
                throw ValidationException::withMessages([
                    'attributeset' => 'Nhóm thuộc tính không hợp lệ.',
                ]);
            }



            $status = $request->status == 'on' ? 1 : 0;
            if ($request->has('values') && is_array($request->values)) {
                $value = json_encode($request->values);
            } else {
                throw ValidationException::withMessages([
                    'value' => 'Vui lòng nhập giá trị thuộc tính'
                ]);
            }

            $data->update([
                'attribute_set_id' => $request->attributeset,
                'name' => $request->input('name'),
                'slug' => generateSlug($request->name, 'attribute'),
                'value' => $value,
                'status' => $status,
            ]);


            return redirect(route('admin.attributes.index'))->withSuccessMessage('Cập nhật thuộc tính thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.attributes.editAttribute', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật thuộc tính.');
        }
    }
    public function delete()
    {
        $id = request()->id;
        $attribute = AttributeSet::find($id);

        if ($attribute == NULL) {
            return redirect(route('admin.attributes.index'))->withErrorMessage('Không tìm thấy thuộc tính.');
        } else {
            if ($attribute->id == AttributeSet::defaultAttributeSet()->id) {
                return redirect()->back()->withErrorMessage('Không thể xoá thuộc tính này.');
            }
            $attribute->delete();
            return redirect(route('admin.attributes.index'))->withSuccessMessage('Xoá thuộc tính thành công');
        }
    }
}
