<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('id', 'desc')->paginate();

        // Top 8 productos más vendidos
        $topProducts = Product::with(['totalSold'])
            ->get()
            ->sortByDesc(function($product) {
                return $product->totalSold->first()->total ?? 0;
            })
            ->take(8);
            

        return view('home', compact('topProducts'));
    }

    
}
