<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VoucherRequestAdmin;
use App\Models\Voucher;
use App\Models\VoucherType;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class VoucherControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $vouchers = Voucher::with('voucherType', 'usages')
                ->select(['id', 'name', 'start_date', 'expired_date', 'voucher_type_id', 'voucher_quantity']);

            if ($request->has('date_range') && !empty($request->get('date_range'))) {
                //2024-10-01 đến 2024-10-31
                // Phân tách chuỗi thành 2 ngày
                $dates = explode(' đến ', $request->get('date_range'));
                if (count($dates) == 2) {
                    // Sử dụng Carbon để phân tích ngày tháng
                    $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
                    $vouchers->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                              ->orWhereBetween('expired_date', [$startDate, $endDate]);
                    });
                }
            }

            $data = DataTables::of($vouchers)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('voucher_quantity', $search)
                                ->orWhereHas('voucherType', function ($subQuery) use ($search) {
                                    $subQuery->where('name', 'like', "%{$search}%");
                                });
                        });
                    }
                })
                ->addColumn('usages_count', function ($row) {
                    return $row->usages()->count();
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.vouchers.editVouchers', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>'
                        . ' <a href="' . route('admin.vouchers.deleteVouchers', $row->id) . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Xóa</a>';
                })
                ->make(true);

            return $data;
        }
        return view('admin.vouchers.index');
    }

    public function history()
    {
        $title = 'Lịch sử sử dụng mã giảm giá';
        $data = VoucherUsage::all();
        showAlert();
        SEOSON($title);
        return view('admin.voucher.history', compact('data'));
    }
    public function add()
    {
        return view('admin.vouchers.add');
    }

    public function postAdd(VoucherRequestAdmin $request)
    {
        try {
            if (VoucherType::where('name', $request->code)->exists()) {
                return redirect()->back()->withErrors(['code' => 'Mã loại giảm giá đã tồn tại'])->withInput();
            }
            $code = $request->code;
            $name = $request->description;
            $start_date = $request->start_date;
            $expired_date = $request->end_date;
            $voucher_quantity = $request->quantity;
            $index = $request->index;
            $discount_type = $request->discount_type;
            $discount = $request->discount;
            $min_spend = $request->min_spend;
            $customer_usage_limit = $request->customer_usage_limit;
            if ($discount_type == "percentage" && ($discount <= 0 || $discount > 100)) {
                return redirect()->back()->withErrors(['discount' => 'Giảm giá phải lớn hơn 0% và nhỏ hơn hoặc bằng 100%'])->withInput();
            } elseif ($discount_type != "percentage" && $discount < 0) {
                return redirect()->back()->withErrors(['discount' => 'Giảm giá không được nhỏ hơn 0'])->withInput();
            }
            if ($min_spend < 0) {
                return redirect()->back()->withErrors(['min_spend' => 'Giá trị tối thiểu cần chi tiêu không được nhỏ hơn 0'])->withInput();
            }
            $formatStartDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $start_date)->format('Y-m-d H:i:s');
            $formatExpiredDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $expired_date)->format('Y-m-d H:i:s');

            $voucherType = VoucherType::create([
                'name' => $code,
                'discount_type' => $discount_type,
                'discount' => (int) $discount,
                'min_spend' => (int) $min_spend,
                'customer_usage_limit' => (int) $customer_usage_limit,
            ]);

            Voucher::create([
                'name' => $name,
                'start_date' => $formatStartDate,
                'expired_date' => $formatExpiredDate,
                'voucher_type_id' => $voucherType->id,
                'voucher_quantity' => (int) $voucher_quantity,
                'index' => (int) $index,
            ]);
            return redirect(route('admin.vouchers.index'))->withSuccessMessage('Thêm mã giảm giá thành công!');
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.vouchers.index'))->withErrorMessage('Thêm mã giảm giá thất bại. Vui lòng thử lại!');
        }
    }

    public function edit($id)
    {
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return redirect(route('admin.vouchers.index'))->withErrorMessage('Không tìm mã giảm giá này.');
        }
        $voucherType = $voucher->voucherType;
        return view('admin.vouchers.edit', compact( 'voucherType', 'voucher'));
    }

    public function postEdit(VoucherRequestAdmin $request, $id)
    {
        try {
            $voucher = Voucher::find($id);
            if (!$voucher) {
                return redirect(route('admin.vouchers.index'))->withErrorMessage('Không tìm thấy mã giảm giá.');
            }

            $voucherType = $voucher->voucherType;

            if (VoucherType::where('name', $request->code)->where('id', '!=', $voucherType->id)->exists()) {
                return redirect()->back()->withErrors(['code' => 'Mã loại giảm giá đã tồn tại'])->withInput();
            }

            $discount_type = $request->discount_type;
            $discount = $request->discount;

            if ($discount_type == "percentage" && ($discount <= 0 || $discount > 100)) {
                return redirect()->back()->withErrors(['discount' => 'Giảm giá phải lớn hơn 0% và nhỏ hơn hoặc bằng 100%'])->withInput();
            } elseif ($discount_type != "percentage" && $discount < 0) {
                return redirect()->back()->withErrors(['discount' => 'Giảm giá không được nhỏ hơn 0'])->withInput();
            }

            $min_spend = $request->min_spend;
            if ($min_spend < 0) {
                return redirect()->back()->withErrors(['min_spend' => 'Giá trị tối thiểu cần chi tiêu không được nhỏ hơn 0'])->withInput();
            }

            $voucher->name = $request->description;
            $voucher->start_date = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $request->start_date)->format('Y-m-d H:i:s');
            $voucher->expired_date = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $request->end_date)->format('Y-m-d H:i:s');
            $voucher->voucher_quantity = (int) $request->quantity;
            $voucher->index = (int) $request->index;

            $voucherType->name = $request->code;
            $voucherType->discount_type = $discount_type;
            $voucherType->discount = (int)$discount;
            $voucherType->min_spend = (int)$min_spend;
            $voucherType->customer_usage_limit = (int)$request->customer_usage_limit;

            $voucherType->save();
            $voucher->save();

            return redirect(route('admin.vouchers.index'))->withSuccessMessage('Sửa mã giảm giá thành công!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect(route('admin.vouchers.index'))->withErrorMessage('Sửa mã giảm giá thất bại. Vui lòng thử lại!');
        }
    }


    public function delete($id)
    {
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return redirect(route('admin.vouchers.index'))->withErrorMessage('Không tìm thấy mã giảm giá.');
        } else {
            Voucher::where('id', $id)->delete();
            VoucherType::where('id', $voucher->voucher_type_id)->delete();
            return redirect(route('admin.vouchers.index'))->withSuccessMessage('Xoá mã giảm giá thành công');;
        }
    }
}
