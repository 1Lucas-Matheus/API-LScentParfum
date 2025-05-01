<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    public function category()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'promo',
        'quantity',
    ];
}