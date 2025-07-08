<?php

namespace App\Http\Controllers;

use App\Models\Bo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoController extends Controller
{
    public function getList(Request $request)
    {
        $query = Bo::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.bo', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        Bo::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('Bo')->with('success', 'Thêm Bộ Mới Thành Công.');
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        // Find the bo by ID
        $bo = Bo::find($request->id);

        if (!$bo) {
            return redirect()->route('Bo')->with('error', 'Bộ không tồn tại.');
        }

        // Update the bo information
        $bo->ten = $request->input('name');
        $bo->moTa = $request->input('desc');

        // Save the updated bo
        $bo->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('Bo')->with('success', 'Cập nhật bộ thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $bo = Bo::findOrFail($request->id);

                // Xóa các bản ghi liên quan
                foreach ($bo->ho as $ho) {
                    foreach ($ho->chi as $chi) {
                        $chi->hoa()->delete();
                    }
                    $ho->chi()->delete();
                }
                $bo->ho()->delete();

                // Xóa bộ
                $bo->delete();
            });

            return redirect()->route('Bo')->with('success', 'Bộ và tất cả các bản ghi liên quan đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('Bo')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}