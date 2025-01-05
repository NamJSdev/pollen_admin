<?php

namespace App\Http\Controllers;

use App\Models\HoaModel;
use Illuminate\Http\Request;

class HoaModelController extends Controller
{
    public function getList(Request $request)
    {
        $query = HoaModel::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ten', 'LIKE', "%{$search}%");
        }
        $datas = $query->paginate(10);

        return view('pages.model', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        HoaModel::create([
            'ten' => $request->input('name'),
            'moTa' => $request->input('desc'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('Model')->with('success', 'Thêm Model Mới Thành Công.');
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
        $model = HoaModel::find($request->id);

        if (!$model) {
            return redirect()->route('Model')->with('error', 'Model trên không tồn tại.');
        }

        // Update the bo information
        $model->ten = $request->input('name');
        $model->moTa = $request->input('desc');

        // Save the updated bo
        $model->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('Model')->with('success', 'Cập nhật model thành công.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        HoaModel::destroy($request->id);

        return redirect()->route('Model')->with('success', 'Model đã được xóa thành công.');
    }
}