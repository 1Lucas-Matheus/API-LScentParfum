<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupom;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function contagens()
    {
        return response()->json([
            'category' => Category::count(),
            'coupom' => Coupom::count(),
            'reminder' => Reminder::count(),
            'product' => Product::count(),
        ]);
    }
}
