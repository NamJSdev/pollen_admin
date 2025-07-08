<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhauDo extends Model
{
    protected $table = 'khaudo';
    protected $fillable = ['ten', 'moTa'];
    public function hoas()
    {
        return $this->hasMany(Hoa::class, 'khauDoID');
    }
}