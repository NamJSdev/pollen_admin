<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaModel extends Model
{
    protected $table = 'model';
    protected $fillable = ['ten', 'moTa'];

    public function hoas()
    {
        return $this->hasMany(Hoa::class, 'modelID');
    }
}