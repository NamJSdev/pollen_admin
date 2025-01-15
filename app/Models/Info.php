<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_tai_khoan';
    protected $fillable = [
        'ten',
        'moTa',
    ];

    public function accounts()
    {
        return $this->hasMany(TaiKhoan::class, 'thongTinTaiKhoanID');
    }
}