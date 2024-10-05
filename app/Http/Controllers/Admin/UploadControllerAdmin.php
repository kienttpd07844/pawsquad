<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Laravel\Facades\Image;

class UploadControllerAdmin extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        if (in_array($extension, ['png', 'jpg', 'gif', 'jpeg', 'webp'])) {
            $foldername = Carbon::now()->format('d-m-Y');
            $filename = Str::random(10) . '.' . $extension;
            $path = public_path('assets/clients/uploads/' . $foldername . '/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true);
            }
            $file->move($path, $filename);
            $filepath = 'public/assets/clients/uploads/' . $foldername . '/' . $filename;
            $request->session()->forget('delete_image');
            $request->session()->put('uploadImage', [
                'image' => encrypt($filepath),
                'folder' => $foldername,
                'filename' => $filename
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully!',
                'filename' => $filepath
            ]);
        }
    }

    public function delete(Request $request)
    {
        $filename = $request->filename;
        $name = $request->query('name');

        $uploadImages = $request->session()->get('uploadImages', []);

        if ($request->session()->has($name . '.image')) {
            $path = str_replace('public/', '', decrypt(session($name . '.image')));
            $updatedUploadImages = array_values(array_filter($uploadImages, function ($uploadImage) use ($path) {
                return decrypt($uploadImage['image']) !== $path;
            }));
            $request->session()->put('uploadImages', $updatedUploadImages);
            $a = 'trường hợp 1';
        } else {
            $path = base_path($filename);
            $a = 'trường hợp 2';
        }

        if (file_exists($path)) {
            unlink($path);
            $request->session()->put('delete_image', true);
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully!',
                'name' => $filename,
                'log' => $a,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'File not found!',
                'path' => $path
            ]);
        }
    }

    public function upload1(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,gif,webp|max:10240',
        ], [
            'required' => 'Vui lòng chọn tệp để tải lên.',
            'file' => 'Tệp tải lên không hợp lệ.',
            'mimes' => 'Tệp phải có định dạng: png, jpg, jpeg, gif, hoặc webp.',
            'max.file' => 'Kích thước tệp không được vượt quá 10MB.',
        ], [
            'file' => 'Hình ảnh',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $validExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
        $validMimeTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];

        if (!in_array($extension, $validExtensions) || !in_array($mimeType, $validMimeTypes)) {
            return response()->json(['success' => false, 'message' => 'Tệp không được phép tải lên'], 400);
        }
        if (in_array($extension, ['png', 'jpg', 'gif', 'jpeg', 'webp'])) {
            // Tạo thư mục lưu trữ nếu chưa tồn tại
            $foldername = Carbon::now()->format('d-m-Y');
            $path = public_path('assets/clients/uploads/' . $foldername . '/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true);
            }

            // Xử lý hình ảnh
            $image = Image::read($file->getRealPath());

            // Mã hoá
            $key = config('app.key');
            $hmac = hash_hmac('sha256', auth()->user()->id, $key);
            $shortHmac = substr($hmac, 0, 8);
            // Tạo tên tệp mới với định dạng WebP
            $filename = $shortHmac . '_' . Str::random(10) . '.webp';

            // Lưu hình ảnh dưới định dạng WebP
            $image->save($path . $filename);

            $filepath = 'public/assets/clients/uploads/' . $foldername . '/' . $filename;
            $uploadImages = $request->session()->get('uploadImages', []);
            $uploadImages[] = [
                'image' => encrypt($filepath),
                'folder' => $foldername,
                'filename' => $filename,
                'type' => $request->input('type'),
            ];
            if (!$request->tinymce) {
                $request->session()->put('uploadImages', $uploadImages);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tải lên thành công!',
                'filename' => $filename,
                'filepath' => $filepath,
                'type' => $request->input('type'),
                'location' => isset($filepath) ? getImage($filepath) : NULL,
            ]);
        }
    }


    public function delete1(Request $request)
    {
        $filename = $request->filename;
        $imagePath = $request->input('filepath');
        $name = $request->name;
        // Kiểm tra xem dữ liệu vừa xóa có trùng với dữ liệu trong session hay không
        $uploadImages = $request->session()->get('uploadImages', []);
        $filteredImages = array_filter($uploadImages, function ($uploadImage) use ($filename) {
            return $uploadImage['filename'] !== $filename;
        });
        // Tiếp tục xử lý xóa file ở đây (ví dụ: sử dụng File::delete())
        if (count($filteredImages) < count($uploadImages)) {
            $request->session()->put('uploadImages', $filteredImages);
            $path = base_path($imagePath);
        } else {
            $path = base_path($imagePath);
            // $path = base_path($filename);
        }
        Log::info($imagePath);
        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully!',
                'filename' => $filename,
                'type' => $request->type,
                'session' => $uploadImages,
                'session1' => $filteredImages
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'File not found!',
            ]);
        }
    }

    public function getimage(Request $request)
    {

        $name = $request->query('name');
        if ($name == 'logo') {
            $oldImagePath = str_replace('public/', '', getOption('DB_LOGO_URL'));
        } else {
            $oldImagePath = str_replace('public/', '', decrypt(session('' . $name . '' . '.image')));
        }

        if (file_exists(public_path($oldImagePath))) {
            $filename = basename($oldImagePath);
            $size = filesize(public_path($oldImagePath));
            return response()->json([
                'status' => 'success',
                'filename' => $filename,
                'size' => $size,
                'url' => asset($oldImagePath)
            ]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function getimage1(Request $request)
    {
        $name = $request->query('name');
        $avatarImage = null;
        if($name){
            $product = request()->session()->get($name);
        }else{
            $product = request()->session()->get('product');
        }

        if (isset($product['image'])) {
            $image = str_replace('public/', '', decrypt($product['image'])); // xóa public cho nó không trùng đường dẫn
            $avatarImage = asset($image);
            $filename = basename($image);
            $size = filesize(public_path($image));
        }

        $detailImages = [];
        $listUrls = [];

        if (isset($product['listimg'])) {
            $listimg = $product['listimg'];
            foreach ($listimg as $imageArray) {
                foreach ($imageArray as $item) {
                    $decodedImage = $item;
                    // var_dump($decodedImage);
                    $limage = str_replace('public/', '', $item);
                    $detailImages[] = [
                        'filename' => basename($limage),
                        'size' => filesize(public_path($limage)),
                        'url' => asset($limage),
                    ];
                    $listUrls[] = asset($limage); // Thêm URL vào mảng $listUrls
                    // var_dump($decodedImage);
                }
            }
        }
        // dd($product['listimg']);
        if (isset($image)) {
            return response()->json([
                'status' => 'success',
                'filename' => $filename,
                'size' => $size,
                'url' => asset($image),
                'filepath' => 'public/' . $image,
                'listUrl' => $listUrls // Sử dụng mảng $listUrls trong response
            ]);
        }
        if (isset($limage)) {
            return response()->json([
                'status' => 'success',
                'filename' => $filename,
                'size' => $size,
                'url' => asset($image),
                'filepath' => 'public/' . $limage,
                'listUrl' => $listUrls // Sử dụng mảng $listUrls trong response
            ]);
        }
    }

    public function delete2(Request $request)
    {
        $filename = $request->filename;
        $imagePath = $request->input('filepath');
        $name = $request->name;


        // Lấy dữ liệu từ phiên 'product'
        $product = $request->session()->get('product');
        $detailImages = isset($product['listimg']) ? $product['listimg'] : [];
        $id = isset($product['id']) ? $product['id'] : null;
        $image = isset($product['image']) ? $product['image'] : null;

        // Kiểm tra xem hình ảnh cần xóa có tồn tại trong danh sách không
        $foundIndex = null;
        foreach ($detailImages as $index => $imageArray) {
            if (isset($imageArray[0]) && $imageArray[0] === $imagePath) {
                $foundIndex = $index;
                break;
            }
        }

        // Xóa hình ảnh khỏi danh sách nếu tìm thấy
        if ($foundIndex !== null) {
            unset($detailImages[$foundIndex]);
            $imageD = array_values($detailImages); // Đánh lại chỉ số của mảng
            $product = $request->session()->get('product');
            $product['listimg'] = $imageD;
            $request->session()->put('product', $product);
        }

        // dd($filename);




        // Tiếp tục xử lý xóa file ở đây (ví dụ: sử dụng File::delete())
        $path = base_path($imagePath);
        // dd($path);
        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully!',
                'filename' => $filename,
                'type' => $request->type,
                'session' => $detailImages,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'File not found!',
            ]);
        }
    }

    public function getFile(Request $request)
    {
        $fileUrls = $request->input('fileUrl');
        $fileInfo = [];
        foreach ($fileUrls as $row) {
            $limage = str_replace('public/', '', $row);
            $filename = basename(asset($limage));
            $size = filesize(public_path($limage));

            $fileInfo[] = [
                'filename' => $filename,
                'size' => $size,
                'url' => asset($limage),
                'filepath' => 'public/' . $limage,
                'type' => 'detail'
            ];
        }
        return response()->json($fileInfo);
    }
}
