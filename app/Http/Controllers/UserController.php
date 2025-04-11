<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class UserController extends Controller
{
    public function dashboard(){
        
        return view('user.dashboard');
    }

    public function index(Request $request){

        $search = $request->input('search');

        $products = Product::with(['author', 'category']) // Carga las relaciones
        ->when($search, function ($query) use ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('author', function($authorQuery) use ($search) {
                      $authorQuery->where('name', 'like', "%$search%")
                                 ->orWhere('lastname', 'like', "%$search%");
                  })
                  ->orWhereHas('category', function($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'like', "%$search%");
                  });
            });
        })
        ->get();



        return view('user.books.index', compact('products', 'search'));
    }

    public function show(Request $request, Product $product){
        return view ('user.books.show', compact('product'));
    }
}
