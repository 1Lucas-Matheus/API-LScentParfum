<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public readonly Cupom $coupons;

    public function __construct()
    {
        $this->coupons = new Cupom();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->coupons->all();

        return response()->json([
            'success' => true,
            'data' => $coupons
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => ['required', 'string', 'size:12', 'unique:coupons,key'],
            'value' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $coupon = $this->coupons->create([
            'key' => $request->key,
            'value' => $request->value
        ]);

        return response()->json([
            'message' => 'Cupom criado com êxito.',
            'coupon' => $coupon
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coupons = $this->coupons->find($id);

        if (!$coupons) {
            return response()->json(['message' => 'Cupom não encontrado.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $coupons
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => ['required', 'string', 'size:12', 'unique:coupons,key,' . $id],
            'value' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $coupon = $this->coupons->find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Cupom não encontrado.'], 404);
        }

        $coupon->update([
            'key' => $request->key,
            'value' => $request->value
        ]);

        return response()->json([
            'message' => 'Cupom atualizado com êxito.',
            'coupon' => $coupon
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = $this->coupons->find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Cupom não encontrado.'], 404);
        }

        $coupon->delete();

        return response()->json(['message' => 'Cupom excluído com êxito.']);
    }
}
