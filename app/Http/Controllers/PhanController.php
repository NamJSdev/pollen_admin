<?php

namespace App\Http\Controllers;

use App\Models\Phan;
use Illuminate\Http\Request;

class PhanController extends Controller
{
    public function getList(Request $request)
    {
        $query = Phan::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.phan', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        Phan::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('Phan')->with('success', 'Thêm Phần Mới Thành Công.');
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
        $phan = Phan::find($request->id);

        if (!$phan) {
            return redirect()->route('Phan')->with('error', 'Phần trên không tồn tại.');
        }

        // Update the bo information
        $phan->ten = $request->input('name');
        $phan->moTa = $request->input('desc');

        // Save the updated bo
        $phan ->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('Phan')->with('success', 'Cập nhật phần thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Phan::destroy($request->id);

        return redirect()->route('Phan')->with('success', 'Phần đã được xóa thành công.');
    }
}