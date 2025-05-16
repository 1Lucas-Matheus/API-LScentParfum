<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Perfume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    public readonly Categoria $categories;

    public function __construct()
    {
        $this->categories = new Categoria();
    }

    /**
     * Display a listing of the categories.
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
     * Store a newly created category.
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
     * Show the form for editing the specified category.
     */
    public function show($id)
    {
        $category = $this->categories->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria não encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Categoria $categoria)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
    ]);

    $categoriaExistente = Categoria::where('name', $request->name)
        ->where('id', '!=', $categoria->id)
        ->exists();

    if ($categoriaExistente) {
        return response()->json([
            'success' => false,
            'message' => 'Já existe outra categoria com esse nome.'
        ], 400);
    }

    $categoria->name = $request->name;
    $updated = $categoria->save();

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
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $category = $this->categories->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria não encontrada.'
            ], 404);
        }

        $Products = Perfume::where('category_id', $id)->exists();

        if ($Products) {
            return response()->json([
                'success' => false,
                'message' => 'Não é possível excluir essa categoria. Existem produtos associados a ela.'
            ], 400);
        }

        $destroy = $category->delete();

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
