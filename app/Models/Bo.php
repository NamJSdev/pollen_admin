<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bo extends Model
{
    protected $table = 'bo';
    protected $fillable = ['ten', 'moTa','created_at','updated_at'];

    public function ho()
    {
        return $this->hasMany(Ho::class, 'boID');
    }
}