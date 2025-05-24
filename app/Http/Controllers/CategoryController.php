<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public readonly Category $categories;

    public function __construct()
    {
        $this->categories = new Category();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categories->all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $existingCategory = $this->categories->where('name', $request->name)->first();

        if ($existingCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Já existe uma categoria com esse nome.'
            ], 400);
        }

        $create = $this->categories->create([
            'name' => $request->name
        ]);

        if ($create) {
            return response()->json([
                'success' => true,
                'message' => 'Categoria criada com êxito.'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao criar categoria'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoriaExistente = Category::where('name', $request->name)
            ->where('id', '!=', $id->id)
            ->exists();

        if ($categoriaExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Já existe outra categoria com esse nome.'
            ], 400);
        }

        $id->name = $request->name;
        $updated = $id->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'A categoria foi atualizada com êxito.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível atualizar a categoria.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $id)
    {
        $id = $this->categories->find($id);

        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria não encontrada.'
            ], 404);
        }

        $Products = Category::where('category_id', $id)->exists();

        if ($Products) {
            return response()->json([
                'success' => false,
                'message' => 'Não é possível excluir essa categoria. Existem produtos associados a ela.'
            ], 400);
        }

        $destroy = $id->delete();

        if ($destroy) {
            return response()->json([
                'success' => true,
                'message' => 'Categoria excluída com êxito.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Não foi possível excluir a categoria.'
        ], 500);
    }
}
