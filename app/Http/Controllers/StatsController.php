<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use Carbon\Carbon;

class StatsController extends Controller
{
    function index(){
        return view('statistics.index');
    }


    public function topProductsThisMonth()
    {
        // Obtener productos más vendidos este mes
        $topProducts = Product::select('products.id', 'products.name')
            ->join('purchases', 'products.id', '=', 'purchases.product_id')
            ->selectRaw('products.name, SUM(purchases.quantity) as total_sold')
            ->whereBetween('purchases.created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        // Formatear respuesta asegurando valores numéricos
        return response()->json([
            'labels' => $topProducts->pluck('name'),
            'data' => $topProducts->pluck('total_sold')->map(function($item) {
                return (int)$item; // Convertir a entero
            })
        ]);
    }
}


