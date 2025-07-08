<?php

namespace App\Http\Controllers;

use App\Models\KhauDo;
use Illuminate\Http\Request;

class KhauDoController extends Controller
{
    public function getList(Request $request)
    {
        $query = KhauDo::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.khau_do', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        KhauDo::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('KhauDo')->with('success', 'Thêm Khẩu Độ Mới Thành Công.');
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
        $khau_do = KhauDo::find($request->id);

        if (!$khau_do) {
            return redirect()->route('KhauDo')->with('error', 'Khẩu độ trên không tồn tại.');
        }

        // Update the bo information
        $khau_do->ten = $request->input('name');
        $khau_do->moTa = $request->input('desc');

        // Save the updated bo
        $khau_do->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('KhauDo')->with('success', 'Cập nhật khẩu độ thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        KhauDo::destroy($request->id);

        return redirect()->route('KhauDo')->with('success', 'Khẩu độ đã được xóa thành công.');
    }
}