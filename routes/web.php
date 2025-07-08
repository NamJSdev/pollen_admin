<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeMatController;
use App\Http\Controllers\BoController;
use App\Http\Controllers\ChiController;
use App\Http\Controllers\HoaController;
use App\Http\Controllers\HoaModelController;
use App\Http\Controllers\HoController;
use App\Http\Controllers\KhauDoController;
use App\Http\Controllers\PhanController;
use Illuminate\Support\Facades\Route;


//Show form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Lấy list tài khoản quản trị hệ thống
Route::get('/tai-khoan-he-thong', [AccountController::class, 'getSupperAdminAccount'])->name('SupperAdminList')->middleware('supperAdmin');
//Lấy list tài khoản nhân viên
Route::get('/tai-khoan-quan-tri', [AccountController::class, 'getAdminAccount'])->name('AdminList')->middleware('supperAdmin');
// Tao tai khoan
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('CreateAccount');
// Sua tai khoan
Route::post('/sua-tai-khoan', [AccountController::class, 'updateAccount'])->name('UpdateAccount');
// Xoa tai khoan
Route::post('/xoa-tai-khoan', [AccountController::class, 'deleteAccount'])->name('DeleteAccount');

//Loai hoa routes
Route::get('/', [HoaController::class, 'getList'])->name('flowers')->middleware('auth');
Route::post('/them-moi-hoa', [HoaController::class, 'store'])->name('ThemHoa')->middleware('auth');
Route::post('/sua-hoa', [HoaController::class, 'update'])->name('SuaHoa')->middleware('auth');
Route::post('/xoa-hoa', [HoaController::class, 'delete'])->name('XoaHoa')->middleware('auth');


//Bo routes
Route::get('/danh-sach-bo', [BoController::class, 'getList'])->name('Bo')->middleware('auth');
Route::post('/them-moi-bo', [BoController::class, 'store'])->name('ThemBo')->middleware('auth');
Route::post('/sua-bo', [BoController::class, 'update'])->name('SuaBo')->middleware('auth');
Route::post('/xoa-bo', [BoController::class, 'delete'])->name('XoaBo')->middleware('auth');
//Ho routes
Route::get('/danh-sach-ho', [HoController::class, 'getList'])->name('Ho')->middleware('auth');
Route::post('/them-moi-ho', [HoController::class, 'store'])->name('ThemHo')->middleware('auth');
Route::post('/sua-ho', [HoController::class, 'update'])->name('SuaHo')->middleware('auth');
Route::post('/xoa-ho', [HoController::class, 'delete'])->name('XoaHo')->middleware('auth');
//Chi routes
Route::get('/danh-sach-chi', [ChiController::class, 'getList'])->name('Chi')->middleware('auth');
Route::post('/them-moi-chi', [ChiController::class, 'store'])->name('ThemChi')->middleware('auth');
Route::post('/sua-chi', [ChiController::class, 'update'])->name('SuaChi')->middleware('auth');
Route::post('/xoa-chi', [ChiController::class, 'delete'])->name('XoaChi')->middleware('auth');

//Be mat routes
Route::get('/danh-sach-be-mat', [BeMatController::class, 'getList'])->name('BeMat')->middleware('auth');
Route::post('/them-moi-be-mat', [BeMatController::class, 'store'])->name('ThemBeMat')->middleware('auth');
Route::post('/sua-be-mat', [BeMatController::class, 'update'])->name('SuaBeMat')->middleware('auth');
Route::post('/xoa-be-mat', [BeMatController::class, 'delete'])->name('XoaBeMat')->middleware('auth');
//Khau do routes
Route::get('/danh-sach-khau-do', [KhauDoController::class, 'getList'])->name('KhauDo')->middleware('auth');
Route::post('/them-moi-khau-do', [KhauDoController::class, 'store'])->name('ThemKhauDo')->middleware('auth');
Route::post('/sua-khau-do', [KhauDoController::class, 'update'])->name('SuaKhauDo')->middleware('auth');
Route::post('/xoa-khau-do', [KhauDoController::class, 'delete'])->name('XoaKhauDo')->middleware('auth');

//Phan routes
Route::get('/danh-sach-phan', [PhanController::class, 'getList'])->name('Phan')->middleware('auth');
Route::post('/them-moi-phan', [PhanController::class, 'store'])->name('ThemPhan')->middleware('auth');
Route::post('/sua-phan', [PhanController::class, 'update'])->name('SuaPhan')->middleware('auth');
Route::post('/xoa-phan', [PhanController::class, 'delete'])->name('XoaPhan')->middleware('auth');

//Hoa Model routes
Route::get('/danh-sach-model', [HoaModelController::class, 'getList'])->name('Model')->middleware('auth');
Route::post('/them-moi-model', [HoaModelController::class, 'store'])->name('ThemModel')->middleware('auth');
Route::post('/sua-model', [HoaModelController::class, 'update'])->name('SuaModel')->middleware('auth');
Route::post('/xoa-model', [HoaModelController::class, 'delete'])->name('XoaModel')->middleware('auth');