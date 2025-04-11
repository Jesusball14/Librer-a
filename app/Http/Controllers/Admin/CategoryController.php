<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(5);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect('categories')
            ->with('success', 'Se ha creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('categories.show', $category)
            ->with('success', 'Se ha actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
        
            
            $category->delete();
        
            // Redireccionar con mensaje de éxito
            return redirect()->route('categories.index')
                ->with('success', 'Categoría eliminado correctamente.');
            
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()
                ->with('error', 'No se pudo eliminar la categoría: ' . $e->getMessage());
        }
    }
}
