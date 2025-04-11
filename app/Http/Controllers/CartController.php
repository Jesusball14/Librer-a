<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if (!$product->hasStock($request->quantity)){
            return back()->with('error', 'No hay suficiente stock disponible');
        }

        $cartItem = Cart::where('user_id', Auth::id())
                       ->where('product_id', $product->id)
                       ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito');
    }

    public function update(Request $request, Cart $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        // Validar stock disponible
        if (!$cartItem->product->hasStock($request->quantity)) {
            return back()->with('error', 'No hay suficiente stock disponible');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado');
    }

    public function remove(Cart $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        // Validar stock antes de procesar la compra
        foreach ($cartItems as $item) {
            if (!$item->product->hasStock($item->quantity)) {
                return redirect()->route('cart.index')
                           ->with('error', "No hay suficiente stock para: {$item->product->title}");
            }
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    public function processCheckout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        foreach ($cartItems as $item) {
            Purchase::create([
                'user_id' => Auth::id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->product->price * $item->quantity
            ]);
            
            // Disminuir el stock
            $item->product->decreaseStock($item->quantity);
        }

        // Vaciar el carrito
        Auth::user()->cartItems()->delete();

        return redirect()->route('purchases.index')->with('success', 'Compra realizada con éxito');
    }
}
