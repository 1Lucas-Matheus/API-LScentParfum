<?php

namespace App\Http\Controllers;

use App\Models\Coupom;
use Illuminate\Http\Request;

class CoupomController extends Controller
{
    public readonly Coupom $coupons;

    public function __construct()
    {
        $this->coupons = new Coupom();
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

        $coupom = $this->coupons->create([
            'key' => $request->key,
            'value' => $request->value
        ]);

        return response()->json([
            'message' => 'Cupom criado com êxito.',
            'coupom' => $coupom
        ], 201);
    }

    public function show(Coupom $coupons)
    {
        $coupons = $this->coupons->all();

        return response()->json([
            'success' => true,
            'data' => $coupons
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupom $coupom)
    {
        $request->validate([
            'key' => ['required', 'string', 'size:12', 'unique:coupons,key,' . $coupom->id],
            'value' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $coupom->update([
            'key' => $request->key,
            'value' => $request->value
        ]);

        return response()->json([
            'message' => 'Cupom atualizado com êxito.',
            'coupom' => $coupom
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupom = $this->coupons->find($id);

        if (!$coupom) {
            return response()->json(['message' => 'Cupom não encontrado.'], 404);
        }

        $coupom->delete();

        return response()->json(['message' => 'Cupom excluído com êxito.']);
    }
}
