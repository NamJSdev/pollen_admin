<?php

namespace App\Http\Controllers;

use App\Models\Bo;
use App\Models\Chi;
use App\Models\Ho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoController extends Controller
{
    public function getList(Request $request)
    {
        $query = Ho::orderBy('id', 'desc');
        $bo_datas = Bo::all();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.ho', compact('datas', 'bo_datas'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'bo' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        Ho::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
            'boID' => $request->input('bo'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('Ho')->with('success', 'Thêm Họ Mới Thành Công.');
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'bo' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        // Find the bo by ID
        $ho = Ho::find($request->id);

        if (!$ho) {
            return redirect()->route('Ho')->with('error', 'Họ không tồn tại.');
        }

        // Update the bo information
        $ho->ten = $request->input('name');
        $ho->moTa = $request->input('desc');
        $ho->boID = $request->input('bo');

        // Save the updated bo
        $ho->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('Ho')->with('success', 'Cập nhật họ thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $ho = Ho::findOrFail($request->id);

                // Xóa tất cả các bản ghi liên quan trong bảng chi
                Chi::where('hoID', $ho->id)->delete();

                // Xóa bản ghi cha
                $ho->delete();
            });

            return redirect()->route('Ho')->with('success', 'Họ và các bản ghi liên quan đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('Ho')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}