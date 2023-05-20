<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Ui\Presets\React;

class carrinhoController extends Controller
{
    public function index(): View
    {
        return view('carrinho.cart');
    }

    public function addToCart(Request $request, $id): RedirectResponse
    {
        // Retrieve the array from the session
        if($request->session()->has('cart')){
            $array = $request->session()->get('cart');
            $count = count($array)+1;
            $newValues = [$count => $id];
            $mergedArray = array_merge($array, $newValues);
            $request->session()->put('cart', $mergedArray);
        }  
        else
            $request->session()->put('cart', [1 => $id]);

        $output = $request->session()->get('cart');
        //$request->session()->flash('message', $output);
        //return redirect()->route('catalogo.index');
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . implode('\n', $output));
    }

}
