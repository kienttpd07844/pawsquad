<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Laravel\Facades\Image;

class EmailControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $categories = EmailContent::select(['id', 'email_type', 'content']);

            $data = DataTables::of($categories)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->get('search')['value'])) {
                        $search = $request->get('search')['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', $search)
                                ->orWhere('email_type', 'like', "%{$search}%")
                                ->orWhereRaw("
                                CASE
                                    WHEN email_type = 'forgotpassword' THEN 'Quên mật khẩu'
                                    WHEN email_type = 'verify' THEN 'Xác minh'
                                    WHEN email_type = 'invoice' THEN 'Hóa đơn'
                                    WHEN email_type = 'invoice_success' THEN 'Thanh toán hóa đơn thành công'
                                    ELSE 'Khác'
                                END LIKE ?
                            ", ["%{$search}%"]);
                        });
                    }
                })
                ->addColumn('name', function ($row) {
                    switch ($row->email_type) {
                        case 'forgotpassword':
                            return 'Quên mật khẩu';
                        case 'verify':
                            return 'Xác minh';
                        case 'invoice':
                            return 'Hóa đơn';
                        case 'invoice_success':
                            return 'Thanh toán hóa đơn thành công';
                        default:
                            return 'Khác';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.emails.editEmail', $row->id) . '" class="btn btn-sm btn-primary">Sửa</a>';
                })
                ->make(true);
            return $data;
        }
        return view('admin.emails.index');
    }
    public function edit($id)
    {
        $data = EmailContent::find($id);
        if (!$data) {
            return redirect(route('admin.emails.index'))->withErrorMessage('Không tìm thấy email.');
        }
        return view('admin.emails.builder', compact('data'));
    }

    public function postEdit(Request $request, $id)
    {
        $data = EmailContent::find($id);
        if (!$data) {
            return response()->json([
                'message' => "Không tìm thấy ID Email"
            ], 404);
        }
        $data->update([
            'content' => $request->input('content'),
        ]);
        return response()->json([
            'success' => "Lưu thành công"
        ], 200);
    }
    public function getTheme($id)
    {
        $data = EmailContent::find($id);
        if (!$data) {
            return redirect(route('admin.emails.index'))->withErrorMessage('Không tìm thấy email.');
        }
        return view('admin.emails.theme', compact('data'));
    }
    public function uploadAsset(Request $request)
    {

        $templateID = $request->input('template_id');

        $path = "assets/builderjs/theme/{$templateID}";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($request->input('assetType') === 'upload') {
            $file = $request->file('file');
            $filename = $this->sanitizeFilename($file->getClientOriginalName());
            $webpFilename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
            $webpPath = "{$path}/{$webpFilename}";
            $img = Image::read($file->getRealPath());
            $img->save($webpPath);
            $filename = $webpFilename;
        } elseif ($request->input('assetType') === 'url') {
            $filename = Str::random(10) . '.webp';
            $filepath = "{$path}/{$filename}";
            $content = file_get_contents($request->input('url'));
            $img = Image::read($content);
            $img->save($filepath);
        } elseif ($request->input('assetType') === 'base64') {
            $filename = Str::random(10) . '.png';
            $filepath = "{$path}/{$filename}";
            $base64Image = base64_decode($request->input('url_base64'));
            file_put_contents($filepath, $base64Image);
        } elseif ($request->input('assetType') === 'audio') {
            $file = $request->file('file');
            $filename = $this->sanitizeFilename($file->getClientOriginalName());
            $filepath = $file->storeAs($path, $filename, 'public');
        }
        return response()->json(['url' => asset("assets/builderjs/theme/{$templateID}/{$filename}")], 200);
    }

    private function sanitizeFilename($filename)
    {
        return preg_replace('/[^a-z0-9\._\-]+/i', '_', $filename);
    }
}
