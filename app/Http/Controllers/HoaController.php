<?php

namespace App\Http\Controllers;

use App\Models\BeMat;
use App\Models\Chi;
use App\Models\Hoa;
use App\Models\HoaModel;
use App\Models\KhauDo;
use App\Models\Phan;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HoaController extends Controller
{
    public function getList(Request $request)
    {
        $chi_datas = Chi::all();
        $be_mat_datas = BeMat::all();
        $phan_datas = Phan::all();
        $khau_do_datas = KhauDo::all();
        $model_datas = HoaModel::all();
        $query = Hoa::with([
            'chi.ho.bo',   // Eager load Chi, Ho, và Bo liên quan
            'beMat',
            'phan',
            'khauDo',
            'model'
        ])
            ->orderBy('id', 'desc');
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('ten', 'LIKE', "%{$search}%")
                    ->orWhere('tenKhoaHoc', 'LIKE', "%{$search}%");
            });
        }
        $datas = $query->paginate(10);
        return view('pages.index', compact('datas', 'chi_datas', 'be_mat_datas', 'phan_datas', 'khau_do_datas', 'model_datas'));
    }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'ten_kh' => 'required|string',
            'kich_thuoc' => 'nullable|string',
            'dac_diem' => 'nullable|string',
            'chi' => 'required|integer',
            'be_mat' => 'required|integer',
            'phan' => 'required|integer',
            'khau_do' => 'required|integer',
            'model' => 'required|integer',
            'anh_hoa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',  // đúng tên trường
            'anh_phan_hoa.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',  // đúng tên trường
        ]);

        // Upload ảnh hoa
        $anhHoaUrl = null;
        if ($request->hasFile('anh_hoa')) {  // Sửa 'image' thành 'anh_hoa'
            $file = $request->file('anh_hoa');
            if ($file->isValid()) {
                // Lưu ảnh vào thư mục 'images' trong storage/app/public
                $anhHoaUrl = $file->store('images', 'public');
                // Tạo URL có thể truy cập từ trình duyệt
                $anhHoaUrl = 'storage/' . $anhHoaUrl;
            } else {
                throw new \Exception('Ảnh hoa không hợp lệ.');
            }
        }

        // Upload các ảnh phấn hoa
        $anhPhanHoaUrls = [];
        if ($request->hasFile('anh_phan_hoa')) {
            // Duyệt qua các tệp ảnh phấn hoa
            foreach ($request->file('anh_phan_hoa') as $file) {
                if ($file->isValid()) {
                    try {
                        // Lưu ảnh vào thư mục 'images' trong storage/app/public
                        $uploadedFileUrl = $file->store('images', 'public');
                        // Tạo URL có thể truy cập từ trình duyệt
                        $uploadedFileUrl = 'storage/' . $uploadedFileUrl;

                        // Thay thế dấu '\/' thành '/' trong mỗi URL
                        $anhPhanHoaUrls[] = str_replace('\/', '/', $uploadedFileUrl);
                    } catch (\Exception $e) {
                        // Log lỗi và tiếp tục với ảnh khác
                        Log::error('Lỗi upload ảnh phấn hoa: ' . $e->getMessage());
                    }
                } else {
                    // Log nếu ảnh không hợp lệ
                    Log::warning('Ảnh phấn hoa không hợp lệ.');
                }
            }
        }

        // Lưu loài hoa vào database
        Hoa::create([
            'ten' => $request->input('name'),  // Đảm bảo bạn lấy đúng tên trường từ form
            'tenKhoaHoc' => $request->input('ten_kh'),
            'kichThuoc' => $request->input('kich_thuoc'),
            'dacDiem' => $request->input('dac_diem'),
            'chiID' => $request->input('chi'),
            'beMatID' => $request->input('be_mat'),
            'phanID' => $request->input('phan'),
            'khauDoID' => $request->input('khau_do'),
            'modelID' => $request->input('model'),
            'anhHoa' => $anhHoaUrl,  // Đảm bảo lưu đúng URL của ảnh hoa
            'anhPhanHoa' => json_encode($anhPhanHoaUrls),  // Lưu các URL ảnh phấn hoa dưới dạng JSON
        ]);

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('flowers')->with('success', 'Loài hoa mới đã được tạo thành công.');
    }

    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'ten_kh' => 'required|string',
            'kich_thuoc' => 'nullable|string',
            'dac_diem' => 'nullable|string',
            'chi' => 'required|integer',
            'be_mat' => 'required|integer',
            'phan' => 'required|integer',
            'khau_do' => 'required|integer',
            'model' => 'required|integer',
            'anh_hoa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'anh_phan_hoa.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $hoa = Hoa::find($request->id);

        // Xóa ảnh hoa cũ nếu có ảnh mới và cập nhật trong DB
        $anhHoaUrl = $hoa->anhHoa; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        if ($request->hasFile('anh_hoa')) {
            // Xóa ảnh cũ trong storage và DB nếu có
            if (Storage::exists('public/' . $hoa->anhHoa)) {
                Storage::delete('public/' . $hoa->anhHoa); // Xóa ảnh cũ trong storage
            }
            $hoa->anhHoa = null; // Xóa ảnh hoa trong DB trước khi cập nhật mới
            $file = $request->file('anh_hoa');
            if ($file->isValid()) {
                // Lưu ảnh mới vào thư mục 'images' trong storage/app/public
                $anhHoaUrl = $file->store('images', 'public');
                // Tạo URL có thể truy cập từ trình duyệt
                $anhHoaUrl = 'storage/' . $anhHoaUrl;
            } else {
                throw new \Exception('Ảnh hoa không hợp lệ.');
            }
        }

        // Xóa các ảnh phấn hoa cũ nếu có ảnh mới và cập nhật trong DB
        $anhPhanHoaUrls = $hoa->anhPhanHoa ? json_decode($hoa->anhPhanHoa, true) : []; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        if ($request->hasFile('anh_phan_hoa')) {
            // Xóa ảnh phấn hoa cũ trong storage
            foreach ($anhPhanHoaUrls as $url) {
                // Chỉ xóa ảnh cũ nếu tồn tại trong storage
                if (Storage::exists('public/' . str_replace(asset('storage/'), '', $url))) {
                    Storage::delete('public/' . str_replace(asset('storage/'), '', $url));
                }
            }
            $anhPhanHoaUrls = null;
            foreach ($request->file('anh_phan_hoa') as $file) {
                if ($file->isValid()) {
                    try {
                        // Lưu ảnh mới vào thư mục 'images' trong storage/app/public
                        $uploadedFileUrl = $file->store('images', 'public');
                        // Tạo URL có thể truy cập từ trình duyệt
                        $uploadedFileUrl = 'storage/' . $uploadedFileUrl;

                        // Thêm URL của ảnh phấn hoa vào danh sách
                        $anhPhanHoaUrls[] = $uploadedFileUrl;
                    } catch (\Exception $e) {
                        // Log lỗi và tiếp tục với ảnh khác
                        Log::error('Lỗi upload ảnh phấn hoa: ' . $e->getMessage());
                    }
                } else {
                    // Log nếu ảnh không hợp lệ
                    Log::warning('Ảnh phấn hoa không hợp lệ.');
                }
            }
        }

        // Cập nhật thông tin loài hoa trong database
        $hoa->update([
            'ten' => $request->input('name'),
            'tenKhoaHoc' => $request->input('ten_kh'),
            'kichThuoc' => $request->input('kich_thuoc'),
            'dacDiem' => $request->input('dac_diem'),
            'chiID' => $request->input('chi'),
            'beMatID' => $request->input('be_mat'),
            'phanID' => $request->input('phan'),
            'khauDoID' => $request->input('khau_do'),
            'modelID' => $request->input('model'),
            'anhHoa' => $anhHoaUrl, // Cập nhật URL ảnh hoa nếu có ảnh mới
            'anhPhanHoa' => json_encode($anhPhanHoaUrls), // Cập nhật danh sách ảnh phấn hoa nếu có ảnh mới
        ]);

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('flowers')->with('success', 'Loài hoa đã được cập nhật thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Hoa::destroy($request->id);

        return redirect()->route('flowers')->with('success', 'Loài hoa đã được xóa thành công.');
    }
}