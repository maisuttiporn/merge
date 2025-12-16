<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv extends Model
{
    use HasFactory;


    public function invdesc()
    {
        return $this->hasMany(\App\Models\Invdesc::class);
    }

    public function invowner()
    {
        return $this->hasMany(\App\Models\Invowner::class);
    }



}
