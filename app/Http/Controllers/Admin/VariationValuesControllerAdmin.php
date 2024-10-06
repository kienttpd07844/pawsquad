<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariationsRequestAdmin;
use App\Models\Variations;
use App\Models\VariationValues;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VariationValuesControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $variations = VariationValues::with('variation')->select(['id', 'variation_id', 'name', 'status']);

            $data = DataTables::of($variations)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhereHas('variation', function ($subQuery) use ($search) {
                                    $subQuery->where('name', 'like', "%{$search}%");
                                })
                                ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('variation_name', function ($row) {
                    $variations = Variations::find($row->variation_id);
                    return $variations ? $variations->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.variations-values.editVariationValues', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>';
                })
                ->make(true);
            return $data;
        }
        return view('admin.variation_values.index');
    }
    public function add()
    {
        $variantions = Variations::select('name', 'id')->get();
        return view('admin.variation_values.add', compact('variantions'));
    }
    public function postAdd(VariationsRequestAdmin $request)
    {
        $variationExists = Variations::where('id', $request->variation_id)->exists();
        if (!$variationExists) {
            return redirect()->back()->withErrorMessage('Biến thể không tồn tại. Vui lòng chọn biến thể hợp lệ.');
        }
        $status = $request->status == 'on' ? 1 : 0;
        try {
            $addVariationValue = VariationValues::create([
                'variation_id' => $request->variation_id,
                'name' => $request->input('name'),
                'status' => $status,
            ]);
            return redirect(route('admin.variations-values.index'))->withSuccessMessage('Thêm giá trị biến thể thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.variations-values.addVariationValues'))->withErrorMessage('Đã xảy ra lỗi khi thêm giá trị biến thể.');
        }
    }
    public function edit($id)
    {
        $data = VariationValues::find($id);
        $variantions = Variations::select('name', 'id')->get();
        if (!$data) {
            return redirect(route('admin.variations-values.index'))->withErrorMessage('Không tìm thấy giá trị biến thể.');
        }
        return view('admin.variation_values.edit', compact('data','variantions'));
    }

    public function postEdit(VariationsRequestAdmin $request, $id)
    {
        $data = VariationValues::find($id);
        if (!$data) {
            return redirect(route('admin.variations-values.index'))->withErrorMessage('Không tìm thấy giá trị biến thể.');
        }
        $variationExists = Variations::where('id', $request->variation_id)->exists();
        if (!$variationExists) {
            return redirect()->back()->withErrorMessage('Biến thể không tồn tại. Vui lòng chọn biến thể hợp lệ.');
        }
        try {
            $status = $request->status == 'on' ? 1 : 0;
            $data->update([
                'variation_id' => $request->variation_id,
                'name' => $request->input('name'),
                'status' => $status,
            ]);
            return redirect(route('admin.variations-values.index'))->withSuccessMessage('Cập nhật giá trị biến thể thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.variations-values.editVariationValues', ['id' => encrypt($id)]))->withErrorMessage('Đã xảy ra lỗi khi cập nhật giá trị biến thể.');
        }
    }
}
