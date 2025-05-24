<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public readonly Product $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products->all();
        $categories = Category::all();

        foreach ($products as $product) {
            $category = $categories->firstWhere('id', $product->category_id);
            $product->category = $category ? $category->name : "Sem categoria";
        }

        return response()->json([
            'dataProducts' => $products,
            'dataCategories' => $categories,
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

        $product = Product::create([
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name,' . $id],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'between:0,9999.99'],
            'promo' => ['nullable', 'numeric', 'between:0,100'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Product::find($id);

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
    public function destroy(Product $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produto excluído com êxito.']);
    }
}
