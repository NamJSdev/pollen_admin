<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phan extends Model
{
    protected $table = 'phan';
    protected $fillable = ['ten', 'moTa'];

    public function hoas()
    {
        return $this->hasMany(Hoa::class, 'phanID');
    }
}