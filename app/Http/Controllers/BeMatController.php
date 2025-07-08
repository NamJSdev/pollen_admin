<?php

namespace App\Http\Controllers;

use App\Models\BeMat;
use Illuminate\Http\Request;

class BeMatController extends Controller
{
    public function getList(Request $request)
    {
        $query = BeMat::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.be_mat', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        BeMat::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('BeMat')->with('success', 'Thêm Bề Mặt Mới Thành Công.');
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
        $be_mat = BeMat::find($request->id);

        if (!$be_mat) {
            return redirect()->route('BeMat')->with('error', 'Bề mặt trên không tồn tại.');
        }

        // Update the bo information
        $be_mat->ten = $request->input('name');
        $be_mat->moTa = $request->input('desc');

        // Save the updated bo
        $be_mat->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('BeMat')->with('success', 'Cập nhật bề mặt thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        BeMat::destroy($request->id);

        return redirect()->route('BeMat')->with('success', 'Bề mặt đã được xóa thành công.');
    }
}