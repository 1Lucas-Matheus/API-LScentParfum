<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lembrete extends Model
{
    protected $table = 'reminders';

    protected $fillable = [
        'reminder',
        'date',
    ];

}