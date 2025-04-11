<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Author;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    function index(){
        $products = Product::orderBy('id', 'desc')->paginate(); //orderBy('id', 'desc') ordena los productos por id de forma descendente

        return view('products.index', compact('products'));
    }

    function create(){
        $authors = Author::all();
        $categories = Category::all();

        return view('products.create', compact('authors', 'categories'));
    }

    function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'authors_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        $product = new Product;
        
        $product->image= $imagePath;
        $product->title = $request->title;
        $product->authors_id = $request['authors_id'];
        $product->category_id = $request['category_id'];
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;

        $product->save();

        return redirect('products')
            ->with('success', 'Se ha creado con exito');
    }

    function show(Product $product){
        return view('products.show', compact('product'));
    }

    function edit(Product $product){
        $authors = Author::all();
        $categories = Category::all();

        
        return view('products.edit', compact('product', 'authors', 'categories'));
    }

    function update(Request $request, Product $product){

        $request->validate([
            'title' => 'required|string|max:255',
            'authors_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar que sea una imagen
        ]);

        //Actualizar la imagen si se sube una nueva

        if ($request->hasFile('image')){
            //Eliminar imagen anterior si hay una
            if ($product->image && Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }

            //Guardar la nueva imagen
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->title = $request->title;
        $product->authors_id = $request['authors_id'];
        $product->category_id = $request['category_id'];
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.show', $product)
            ->with('success', 'Se ha actualizado con exito');
    }

    // function destroy(Product $product){

    //     $product->purchases()->delete();
    //     // Eliminar la imagen si existe
    //     if ($product->image && Storage::disk('public')->exists($product->image)) {
    //         Storage::disk('public')->delete($product->image);
    //     }

    //     $product->delete();

    //     return redirect('products')->with('success', 'Producto eliminado correctamente.');
    // }


    public function destroy(Product $product)
    {
        try {
            // Eliminar compras relacionadas
            $product->purchases()->delete();
        
            // Eliminar la imagen si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        
            // Eliminar el producto
            $product->delete();
        
            // Redireccionar con mensaje de éxito
            return redirect()->route('products.index')
                ->with('success', 'Producto eliminado correctamente.');
            
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()
                ->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }



}
