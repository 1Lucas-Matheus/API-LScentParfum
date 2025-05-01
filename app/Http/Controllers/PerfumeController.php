<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Perfume;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public readonly Perfume $products;

    public function __construct()
    {
        $this->products = new Perfume();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products->all();
        $categories = Categoria::all();

        return response()->json([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'promo' => ['nullable', 'numeric', 'between:0,100'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Perfume::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'promo' => $request->promo ?? 0,
        ]);

        return response()->json([
            'message' => 'Produto criado com êxito.',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Perfume::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name,' . $id],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'promo' => ['nullable', 'numeric', 'between:0,100'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Perfume::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'promo' => $request->promo ?? 0,
        ]);

        return response()->json([
            'message' => 'Produto atualizado com êxito.',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Perfume::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produto excluído com êxito.']);
    }
}
