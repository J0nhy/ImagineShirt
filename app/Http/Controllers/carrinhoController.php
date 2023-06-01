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

        if ($array == null)
            return view('carrinho.cart')->with('cart', null);

        $cart = array();
        $iterator = 0;
        foreach ($array as $produto) {
            $produto = explode(";", $produto);
            $cart[$iterator] = array(
                "image_url" => $produto[0],
                "name" => $produto[1],
                "cor" => $produto[2],
                "size" => $produto[3]
            );
            //array_push($cart[$iterator], $produto[0]);
            //array_push($cart[$iterator], $produto[1]);
            //array_push($cart[$iterator], $produto[2]);
            //array_push($cart[$iterator], $produto[3]);
            $iterator++;
        }

        if ($cart == null)
            return view('carrinho.cart')->with('cart', null);

        $price = prices::all();

        return view('carrinho.cart', compact('cart', 'price'));
    }

    public function addToCart(Request $request, $url, $nome, $cor, $size): RedirectResponse
    {
        // Retrieve the array from the session
        if($request->session()->has('cart')){
            $array = $request->session()->get('cart');
            $count = count($array)+1;
            $newValues = [$count => $url . ";" . $nome .";" . $cor . ";" . $size];
            $mergedArray = array_merge($array, $newValues);
            $request->session()->put('cart', $mergedArray);
        }
        else{
            $request->session()->put('cart', [1 => $url . ";" . $nome .";" . $cor . ";" . $size]);
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
