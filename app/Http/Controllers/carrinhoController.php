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

        $cart = tshirt_images::whereIn('image_url', $array)->get();
        $price = prices::all();

        return view('carrinho.cart', compact('cart', 'price'));
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
        $request->session()->put('itemCount', $count);
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . implode('\n', $output));
    }

}
