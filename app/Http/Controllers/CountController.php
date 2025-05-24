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
            'categories' => Category::count(),
            'coupons' => Coupom::count(),
            'reminders' => Reminder::count(),
            'products' => Product::count(),
        ]);
    }
}
