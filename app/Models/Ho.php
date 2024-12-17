<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ho extends Model
{
    protected $table = 'ho';
    protected $fillable = ['ten', 'moTa', 'boID'];

    public function bo()
    {
        return $this->belongsTo(Bo::class, 'boID');
    }

    public function chi()
    {
        return $this->hasMany(Chi::class, 'hoID');
    }
}