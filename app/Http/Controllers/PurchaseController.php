<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showPurchaseForm(Product $product){
        return view('purchase.create', compact('product'));
    }

    public function processPurchase(Request $request, Product $product){
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $total_price = $product->price * $request->quantity;

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price
        ]);

        return redirect()->route('purchases.index')->with('success', '¡Compra realizada con éxito!');
    }

    public function userPurchases(){
        $purchases = Auth::user()->purchases()->with('product')->latest()->paginate(10);
        return view('purchase.index', compact('purchases'));
    }
}
