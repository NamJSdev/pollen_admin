<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;
    protected $table = 'quyen';
    protected $fillable = [
        'ten',
        'moTa',
    ];

    public function accounts()
    {
        return $this->hasMany(TaiKhoan::class, 'quyenID');
    }
}