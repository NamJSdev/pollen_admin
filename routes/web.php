<?php

use App\Http\Controllers\BoController;
use App\Http\Controllers\HoaController;
use Illuminate\Support\Facades\Route;

//Loai hoa routes
Route::get('/', [HoaController::class, 'getList'])->name('flowers');

//Bo routes
Route::get('/danh-sach-bo', [BoController::class, 'getList'])->name('Bo');
Route::post('/them-moi-bo', [BoController::class, 'store'])->name('ThemBo');
Route::post('/sua-bo', [BoController::class, 'update'])->name('SuaBo');
Route::post('/xoa-bo', [BoController::class, 'delete'])->name('XoaBo');