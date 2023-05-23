<?php

namespace App\Http\Controllers;

use App\Models\tshirt_images;
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
        /*$data = [];
        foreach ($array as $item){
            $result = DB::table('tshirt_images')->where('image_url', $item)->get();
            json_decode(json_encode($result), true);
            array_push($data, json_decode(json_encode($result), true));
        }
        return view('carrinho.cart')->with('cart', $data);*/
        $carrinho = tshirt_images::whereIn('image_url', $array)->get();
        return view('carrinho.cart')->with('cart', $carrinho);
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
