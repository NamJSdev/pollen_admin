<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hoa extends Model
{
    protected $table = 'hoa';
    protected $fillable = ['ten', 'tenKhoaHoc', 'anhHoa', 'anhPhanHoa', 'kichThuoc', 'dacDiem', 'chiID', 'beMatID', 'phanID', 'khauDoID', 'modelID', 'status'];

    public function chi()
    {
        return $this->belongsTo(Chi::class, 'chiID');
    }

    public function beMat()
    {
        return $this->belongsTo(BeMat::class, 'beMatID');
    }

    public function phan()
    {
        return $this->belongsTo(Phan::class, 'phanID');
    }

    public function khauDo()
    {
        return $this->belongsTo(KhauDo::class, 'khauDoID');
    }

    public function model()
    {
        return $this->belongsTo(HoaModel::class, 'modelID');
    }
}