<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BeMatController;
use App\Http\Controllers\BoController;
use App\Http\Controllers\ChiController;
use App\Http\Controllers\HoaController;
use App\Http\Controllers\HoaModelController;
use App\Http\Controllers\HoController;
use App\Http\Controllers\KhauDoController;
use App\Http\Controllers\PhanController;
use Illuminate\Support\Facades\Route;

//Lấy list tài khoản quản trị hệ thống
Route::get('/tai-khoan-he-thong', [AccountController::class, 'getSupperAdminAccount'])->name('SupperAdminList');
//Lấy list tài khoản nhân viên
Route::get('/tai-khoan-quan-tri', [AccountController::class, 'getAdminAccount'])->name('AdminList');
// Tao tai khoan
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('CreateAccount');
// Sua tai khoan
Route::post('/sua-tai-khoan', [AccountController::class, 'updateAccount'])->name('UpdateAccount');
// Xoa tai khoan
Route::post('/xoa-tai-khoan', [AccountController::class, 'deleteAccount'])->name('DeleteAccount');

//Loai hoa routes
Route::get('/', [HoaController::class, 'getList'])->name('flowers');
Route::post('/them-moi-hoa', [HoaController::class, 'store'])->name('ThemHoa');
Route::post('/sua-hoa', [HoaController::class, 'update'])->name('SuaHoa');
Route::post('/xoa-hoa', [HoaController::class, 'delete'])->name('XoaHoa');


//Bo routes
Route::get('/danh-sach-bo', [BoController::class, 'getList'])->name('Bo');
Route::post('/them-moi-bo', [BoController::class, 'store'])->name('ThemBo');
Route::post('/sua-bo', [BoController::class, 'update'])->name('SuaBo');
Route::post('/xoa-bo', [BoController::class, 'delete'])->name('XoaBo');
//Ho routes
Route::get('/danh-sach-ho', [HoController::class, 'getList'])->name('Ho');
Route::post('/them-moi-ho', [HoController::class, 'store'])->name('ThemHo');
Route::post('/sua-ho', [HoController::class, 'update'])->name('SuaHo');
Route::post('/xoa-ho', [HoController::class, 'delete'])->name('XoaHo');
//Chi routes
Route::get('/danh-sach-chi', [ChiController::class, 'getList'])->name('Chi');
Route::post('/them-moi-chi', [ChiController::class, 'store'])->name('ThemChi');
Route::post('/sua-chi', [ChiController::class, 'update'])->name('SuaChi');
Route::post('/xoa-chi', [ChiController::class, 'delete'])->name('XoaChi');

//Be mat routes
Route::get('/danh-sach-be-mat', [BeMatController::class, 'getList'])->name('BeMat');
Route::post('/them-moi-be-mat', [BeMatController::class, 'store'])->name('ThemBeMat');
Route::post('/sua-be-mat', [BeMatController::class, 'update'])->name('SuaBeMat');
    Route::post('/xoa-be-mat', [BeMatController::class, 'delete'])->name('XoaBeMat');

//Khau do routes
Route::get('/danh-sach-khau-do', [KhauDoController::class, 'getList'])->name('KhauDo');
Route::post('/them-moi-khau-do', [KhauDoController::class, 'store'])->name('ThemKhauDo');
Route::post('/sua-khau-do', [KhauDoController::class, 'update'])->name('SuaKhauDo');
Route::post('/xoa-khau-do', [KhauDoController::class, 'delete'])->name('XoaKhauDo');

//Phan routes
Route::get('/danh-sach-phan', [PhanController::class, 'getList'])->name('Phan');
Route::post('/them-moi-phan', [PhanController::class, 'store'])->name('ThemPhan');
Route::post('/sua-phan', [PhanController::class, 'update'])->name('SuaPhan');
Route::post('/xoa-phan', [PhanController::class, 'delete'])->name('XoaPhan');

//Hoa Model routes
Route::get('/danh-sach-model', [HoaModelController::class, 'getList'])->name('Model');
Route::post('/them-moi-model', [HoaModelController::class, 'store'])->name('ThemModel');
Route::post('/sua-model', [HoaModelController::class, 'update'])->name('SuaModel');
Route::post('/xoa-model', [HoaModelController::class, 'delete'])->name('XoaModel');