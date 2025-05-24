<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupom extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'value',
        'key'
    ];
}
