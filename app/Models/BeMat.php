<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeMat extends Model
{
    protected $table = 'bemat';
    protected $fillable = ['ten', 'moTa'];

    public function hoas()
    {
        return $this->hasMany(Hoa::class, 'beMatID');
    }
}