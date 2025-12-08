<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;


    public function Checkindesc()
    {
        return $this->hasMany(\App\Models\Checkindesc::class);
    }

    public function paid()
    {
        if ($this->checkin_payment == '0') {
            return 'ไม่จ่าย';
        }  else {
            return 'จ่าย';
        }
    }

    public function lock()
    {
        if ($this->checkin_lock == '0') {
            return 'เปิด';
        }  else {
            return 'ปิด';
        }
    }

    public function win()
    {
        if ($this->checkin_win == '0') {
            return '';
        }  else {
            return 'ชนะ';
        }
    }




}
