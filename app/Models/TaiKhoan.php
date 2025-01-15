<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'tai_khoan';
    protected $fillable = [
        'email',
        'matKhau',
        'quyenID',
        'thongTinTaiKhoanID',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function setMatKhauAttribute($value)
    {
        $this->attributes['matKhau'] = Hash::make($value);
    }

    public function role()
    {
        return $this->belongsTo(Quyen::class, 'quyenID');
    }

    public function info()
    {
        return $this->belongsTo(Info::class, 'thongTinTaiKhoanID');
    }
}