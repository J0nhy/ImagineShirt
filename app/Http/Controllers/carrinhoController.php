<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\order_items;
use App\Models\tshirt_images;
use App\Models\prices;
use App\Models\colors;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;

class carrinhoController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart');

        if ($cart == null)
            return view('carrinho.cart')->with('cart', null);

        $price = prices::all();

        return view('carrinho.cart', compact('cart', 'price'));
    }

    public function addToCart(Request $request, $id, $url, $nome, $cor, $size, $qtd, $corCode, $own): RedirectResponse
    {
        $arrayId = $url . $cor . $size;
        // Retrieve the array from the session
        if ($request->session()->has('cart')) {
            $array = $request->session()->get('cart');
            $igual = array_key_exists($id, $array);

            if ($igual == false) {
                $count = count($array) + 1;
                $array[$arrayId] = array(
                    "image_url" => $url,
                    "name" => $nome,
                    "cor" => $cor,
                    "size" => $size,
                    "qtd" => $qtd,
                    "id" => $id,
                    "colorCode" => $corCode,
                    "own" => $own
                );
                $request->session()->put('cart', $array);
            } else {
                $count = count($array);
                $array[$arrayId] = array(
                    "image_url" => $url,
                    "name" => $nome,
                    "cor" => $cor,
                    "size" => $size,
                    "qtd" => $array[$id]["qtd"] + $qtd,
                    "id" => $id,
                    "colorCode" => $corCode,
                    "own" => $own
                );
                $request->session()->put('cart', $array);
            }
        } else {
            $array[$arrayId] = array(
                "image_url" => $url,
                "name" => $nome,
                "cor" => $cor,
                "size" => $size,
                "qtd" => $qtd,
                "id" => $id,
                "colorCode" => $corCode,
                "own" => $own
            );
            $request->session()->put('cart', $array);
            $count = 1;
        }

        $request->session()->put('itemCount', $count);
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . $arrayId);
    }

    public function removeFromCart(Request $request, $id): RedirectResponse
    {
        // Retrieve the array from the session
        $array = $request->session()->get('cart');
        unset($array[$id]);
        $request->session()->put('cart', $array);

        $output = $request->session()->get('cart');
        $request->session()->put('itemCount', count($array));
        return redirect()->back()->with('message', "Artigo(s) adicionado(s): " . $id);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $total = $request->input('total');

            if ($request->session()->has('cart')) {
                $array = $request->session()->get('cart');
                $count = count($array);
                if ($count < 1) {
                    $htmlMessage = "Não existem produtos no carrinho.";
                    $alertType = 'alert';
                } else {
                    $qtds = array();
                    $iterator = 0;
                    foreach ($array as $item) {
                        $qtds['qty' . $iterator] = $request->input('qty' . $iterator); //ta a vir null
                        $iterator++;
                    }
                    $order = DB::transaction(function () use ($array, $total, $qtds) {
                        $newOrder = new orders();
                        $newOrder->status = "pending";
                        $newOrder->customer_id = 155; //posteriormente mudar quando ja tiverem as contas de utilizador a funcionar
                        $newOrder->date = date("Y-m-d");
                        $newOrder->total_price = $total;
                        $newOrder->nif = "429223586"; //posteriormente mudar quando ja tiverem as contas de utilizador a funcionar
                        $newOrder->address = "Tv. Maia, nº 37 4524-258 Seixal";
                        $newOrder->payment_type = "PAYPAL"; //mudar quando se fizer a pagina de checokut
                        $newOrder->payment_ref = "5251638642578549"; //mudar quando se fizer a pagina de checokut
                        $newOrder->save();
                        $iterator = 0;
                        foreach($array as $item){
                            $newOrderItem = new order_items();
                            $newOrderItem->order_id = $newOrder->id;
                            $newOrderItem->tshirt_image_id = $item["id"];
                            $newOrderItem->color_code = $item["colorCode"];
                            $newOrderItem->size = $item["size"];
                            $newOrderItem->qty = $qtds['qty' . $iterator];
                            if($item["own"] == "True")
                                $newOrderItem->unit_price = prices::first()->unit_price_own;
                            else
                                $newOrderItem->unit_price = prices::first()->unit_price_catalog;
                            $newOrderItem->sub_total = $newOrderItem->qty * $newOrderItem->unit_price;
                            $newOrderItem->save();
                            $iterator++;
                        }
                        return $newOrder->id;
                    });
                    $htmlMessage = "<strong>A sua encomenda foi concluida com sucesso: " . $total . "produto(s).</strong>";

                    $request->session()->forget('cart');
                    return redirect()->route('carrinho.cart')
                        ->with('message', $htmlMessage);
                }
            }else{
                $htmlMessage = "Não existem produtos no carrinho.";
            }
        } catch (\Exception $error) {
            dd($error);
            $htmlMessage = "Não foi possível concluir a encomenda, porque ocorreu um erro!";
        }
        return back()
            ->with('message', $htmlMessage);
    }
}
