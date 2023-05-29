<?php

namespace App\Http\Controllers;

use App\Models\tshirt_images;
use App\Models\prices;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;

class carrinhoController extends Controller
{
    public function index(Request $request): View
    {
        $array = $request->session()->get('cart');
        //$arrayCor = $request->session()->get('cor');
        //$arraySize = $request->session()->get('size');
        $produtos = [];
        $cores = [];
        $sizes = [];
        foreach ($array as $produto) {
            $produto = explode(";", $produto);
            array_push($produtos, $produto[0]);
            array_push($cores, $produto[1]);
            array_push($sizes, $produto[2]);
        }

        if ($produtos == null)
            return view('carrinho.cart')->with('cart', null);

        $cart = tshirt_images::WhereIn('image_url', $produtos)->get(); //nao esta a aparecer repetidos porque ele armazena 
                                                                       //na var $cart os valores que dao match, se 1 valor ja deu match n vai add outra vez
        $price = prices::all();

        return view('carrinho.cart', compact('cart', 'price', 'cores', 'sizes'));
    }

    public function addToCart(Request $request, $id, $cor, $size): RedirectResponse
    {
        // Retrieve the array from the session
        if($request->session()->has('cart')){
            $array = $request->session()->get('cart');
            $count = count($array)+1;
            $newValues = [$count => $id . ";" . $cor . ";" . $size];
            $mergedArray = array_merge($array, $newValues);
            $request->session()->put('cart', $mergedArray);
        }
        else{
            $request->session()->put('cart', [1 => $id . ";" . $cor . ";" . $size]);
            $count = 1;
        }

        $output = $request->session()->get('cart');
        $request->session()->put('itemCount', $count);
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . implode('\n', $output));
    }

    public function removeFromCart(Request $request, $id): RedirectResponse
    {
        // Retrieve the array from the session
        $array = $request->session()->get('cart');
        unset($array[array_search($id, $array)]);
        $request->session()->put('cart', $array);

        $output = $request->session()->get('cart');
        $request->session()->put('itemCount', count($array));
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . implode('\n', $output));
    }
}
