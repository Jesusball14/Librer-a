<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    function index(){
        $shoppings = Shopping::all();

        return view('shopping.index', compact('shoppings'));
    }
}
