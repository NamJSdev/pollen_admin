<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chi extends Model
{
    protected $table = 'chi';
    protected $fillable = ['ten', 'moTa', 'hoID'];

    public function ho()
    {
        return $this->belongsTo(Ho::class, 'hoID');
    }

    public function hoa()
    {
        return $this->hasMany(Hoa::class, 'chiID');
    }
}