<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    function index(){
        $authors = Author::orderBy('id', 'desc')->paginate();

        return view('admin.authors.index', compact('authors'));
    }

    function create(){
        return view('admin.authors.create');
    }

    function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:121',
            'lastname' => 'required|string|max:121',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('authors', 'public');
        } else {
            $imagePath = null;
        }

        $author = new Author;

        $author->image= $imagePath;
        $author->name = $request->name;
        $author->lastname = $request->lastname;
        $author->description = $request->description;

        $author->save();

        return redirect('authors')->with('success', 'Se ha creado con éxito');
    }

    function show(Author $author){
        return view('admin.authors.show', compact('author'));
    }

    function edit(Author $author){
        return view('admin.authors.edit', compact('author'));
    }

    function update(Request $request, Author $author){
        $request->validate([
            'name' => 'required|string|max:121',
            'lastname' => 'required|string|max:121',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);

        //Actualizar la imagen si se sube una nueva

        if ($request->hasFile('image')){
            //Eliminar imagen anterior si hay una
            if ($author->image && Storage::disk('public')->exists($author->image)){
                Storage::disk('public')->delete($author->image);
            }

            //Guardar la nueva imagen
            $imagePath = $request->file('image')->store('authors', 'public');
            $author->image = $imagePath;
        }

        $author->name = $request->name;
        $author->lastname = $request->lastname;
        $author->description = $request->description;

        $author->save();
        return redirect()->route('authors.show', $author)
            ->with('success', 'Se ha actualizado con exito');
        
    }

    function destroy(Author $author){

        try {
        
            // Eliminar la imagen si existe
            if ($author->image && Storage::disk('public')->exists($author->image)) {
                Storage::disk('public')->delete($author->image);
            }
        
            // Eliminar el producto
            $author->delete();
        
            // Redireccionar con mensaje de éxito
            return redirect()->route('authors.index')
                ->with('success', 'Autor eliminado correctamente.');
            
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()
                ->with('error', 'No se pudo eliminar el autor: ' . $e->getMessage());
        }
    }
}
