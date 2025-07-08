<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getSupperAdminAccount()
    {
        $datas = TaiKhoan::where('quyenID', 1)->get();
        return view('pages.supper_admin', compact('datas'));
    }
    public function getAdminAccount()
    {
        $datas = TaiKhoan::where('quyenID', 2)->get();
        return view('pages.admin', compact('datas'));
    }
    public function createAccount(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ten' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|integer',
            'matKhau' => 'required|min:6',
            'moTa' => 'nullable|string',
        ]);

        // Create a new record in the 'infos' table
        $info = Info::create([
            'ten' => $request->input('ten'),
            'moTa' => $request->input('moTa'),
        ]);

        // Create a new record in the 'accounts' table
        $account = TaiKhoan::create([
            'email' => $request->input('email'),
            'matKhau' => bcrypt($request->input('matKhau')),
            'quyenID' => $request->input('role'),
            'thongTinTaiKhoanID' => $info->id,
        ]);

        if ($request->input('role') == 1) {
            return redirect()->route('SupperAdminList')->with('success', 'Tài Khoản đã được tạo thành công.');
        } else {
            return redirect()->route('AdminList')->with('success', 'Tài Khoản đã được tạo thành công.');
        }
    }
    public function updateAccount(Request $request)
    {
        // dd($request->user_name);
        $request->validate([
            'id' => 'required|integer',
            'ten' => 'required|string|max:255',
            'moTa' => 'string|max:255',
            'email' => 'required|string|max:255|email',
            'matKhau' => 'nullable|string|min:6',
        ]);
        // Find the account by ID
        $account = TaiKhoan::find($request->id);
        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        // Update mật khẩu nếu có thay đổi
        if (!empty($request->matKhau)) {
            $account->matKhau = bcrypt($request->matKhau);
        }
        $account->save();

        // Update the info details
        $info = Info::find($account->thongTinTaiKhoanID);
        if ($info) {
            $info->ten = $request->ten;
            $info->moTa = $request->moTa;
            $info->save();
        } else {
            return redirect()->back()->with('error', 'Associated info not found.');
        }

        if ($account->quyenID == 1) {
            return redirect()->route('SupperAdminList')->with('success', 'Tài khoản đã được cập nhật thành công.');
        } else {
            return redirect()->route('AdminList')->with('success', 'Tài khoản đã được cập nhật thành công.');
        }
    }
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $role = TaiKhoan::find($request->id)->quyenID;
        $infoID = TaiKhoan::find($request->id)->thongTinTaiKhoanID;
        TaiKhoan::destroy($request->id);
        // Nếu tồn tại thông tin tài khoản thì xóa luôn
        if ($infoID) {
            Info::destroy($infoID);
        }
        if ($role == 1) {
            return redirect()->route('SupperAdminList')->with('success', 'Tài khoản đã được xóa thành công.');
        } else {
            return redirect()->route('AdminList')->with('success', 'Tài khoản đã được xóa thành công.');
        }
    }
}