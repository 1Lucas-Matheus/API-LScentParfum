<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cupom;
use App\Models\Lembrete;
use App\Models\Perfume;

class ResumoController extends Controller
{
    public function contagens()
    {
        return response()->json([
            'categorias' => Categoria::count(),
            'cupons' => Cupom::count(),
            'lembretes' => Lembrete::count(),
            'perfumes' => Perfume::count(),
        ]);
    }
}
