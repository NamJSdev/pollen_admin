<?php

namespace App\Http\Controllers;

use App\Models\Chi;
use App\Models\Ho;
use App\Models\Hoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChiController extends Controller
{
    public function getList(Request $request)
    {
        $query = Chi::orderBy('id', 'desc');
        $ho_datas = Ho::all();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.chi', compact('datas', 'ho_datas'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ho' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);
        Chi::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
            'hoID' => $request->input('ho'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('Chi')->with('success', 'Thêm Chi Mới Thành Công.');
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'ho' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        // Find the bo by ID
        $chi = Chi::find($request->id);

        if (!$chi) {
            return redirect()->route('Chi')->with('error', 'Chi không tồn tại.');
        }

        // Update the bo information
        $chi->ten = $request->input('name');
        $chi->moTa = $request->input('desc');
        $chi->hoID = $request->input('ho');

        // Save the updated bo
        $chi->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('Chi')->with('success', 'Cập nhật chi thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $chi = Chi::findOrFail($request->id);

                // Xóa tất cả các bản ghi liên quan trong bảng Hoa
                Hoa::where('chiID', $chi->id)->delete();

                // Xóa bản ghi cha
                $chi->delete();
            });

            return redirect()->route('Chi')->with('success', 'Chi và các bản ghi liên quan đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('Chi')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}