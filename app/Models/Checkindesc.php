<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkindesc extends Model
{
    use HasFactory;

    public function checkin()
    {
        return $this->belongsTo(\App\Models\Checkin::class);
    }
}
