<?php

namespace App\Http\Controllers;

use App\Models\colors;
use App\Models\orders;
use App\Models\prices;
use App\Mail\MailSender;
use App\Models\customers;
use Illuminate\View\View;
use App\Models\order_items;
use Illuminate\Http\Request;
use App\Models\tshirt_images;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class carrinhoController extends Controller
{

    public function index(Request $request): View
    {
        if (!Auth::user() || Auth::user()->user_type == 'C') {

            $cart = $request->session()->get('cart');

            if ($cart == null)
                return view('carrinho.cart')->with('cart', null);

            $price = prices::all();

            return view('carrinho.cart', compact('cart', 'price'));
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function checkout(Request $request): View
    {
        if (Auth::user()->user_type == 'C') {
            $total = $request->input('total');
            $array = $request->session()->get('cart');

            $iterator = 0;
            foreach ($array as $item) {

                $array[$item["image_url"] . $item["cor"] . $item["size"]] = array(
                    "image_url" => $item["image_url"],
                    "name" => $item["name"],
                    "cor" => $item["cor"],
                    "size" => $item["size"],
                    "qtd" => $request->input('qty' . $iterator),
                    "id" => $item["id"],
                    "colorCode" => $item["colorCode"],
                    "own" => $item["own"]
                );
                $iterator++;
            }

            if ($array == null)
                return view('carrinho.cart')->with('cart', null);

            $customer = customers::where('id', '=', Auth::user()->id ?? '')->first();

            return view('carrinho.checkout', compact('array', 'total', 'customer'));
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function addToCart(Request $request, $id, $url, $nome, $cor, $size, $qtd, $corCode, $own): RedirectResponse
    {
        if (!Auth::user() || Auth::user()->user_type == 'C') {
            $arrayId = $url . $cor . $size;
            // Retrieve the array from the session
            if ($request->session()->has('cart')) {
                $array = $request->session()->get('cart');
                $igual = array_key_exists($arrayId, $array);

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
                        "qtd" => $array[$arrayId]["qtd"] + $qtd,
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
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function removeFromCart(Request $request, $id): RedirectResponse
    {
        if (!Auth::user() || Auth::user()->user_type == 'C') {
            // Retrieve the array from the session
            $array = $request->session()->get('cart');
            unset($array[$id]);
            $request->session()->put('cart', $array);

            $output = $request->session()->get('cart');
            $request->session()->put('itemCount', count($array));
            return redirect()->back()->with('message', "Artigo(s) removido(s): " . $id);
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function store(Request $request): View
    {
        if (!Auth::user() || Auth::user()->user_type == 'C') {
            $total = $request->input('total');
            try {

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
                            $qtds['qty' . $iterator] = $request->input('qty' . $iterator);
                            $iterator++;
                        }
                        try {
                            $customer = customers::where('id', '=', Auth::user()->id ?? '')->first();
                        } catch (\Exception $error) {
                            $htmlMessage = "User não existe ou dados estão incorretos";
                        }
                        $orderId = DB::transaction(function () use ($array, $total, $qtds, $customer, $request) {
                            $newOrder = new orders();
                            $newOrder->status = "pending";
                            $newOrder->customer_id = $customer->id;
                            $newOrder->date = date("Y-m-d");
                            $newOrder->total_price = $total;

                            $newOrder->nif = $request->input('NIF');
                            $newOrder->address = $request->input('Morada') .
                                ($request->input('cod') !== null ? ", " . $request->input('cod') : "") .
                                ($request->input('Localidade') !== null ? ", " . $request->input('Localidade') : "");
                            $newOrder->payment_type = $request->input('payment');
                            $newOrder->notes = $request->input('Descricao') ?? "";

                            $newOrder->payment_ref = $customer->default_payment_ref ?? (Auth::user()->mail ?? '');
                            $newOrder->save();
                            $iterator = 0;
                            foreach ($array as $item) {
                                $newOrderItem = new order_items();
                                $newOrderItem->order_id = $newOrder->id;
                                $newOrderItem->tshirt_image_id = $item["id"];
                                $newOrderItem->color_code = $item["colorCode"];
                                $newOrderItem->size = $item["size"];
                                $newOrderItem->qty = $item["qtd"];
                                if ($item["own"] == "True")
                                    $newOrderItem->unit_price = prices::first()->unit_price_own;
                                else
                                    $newOrderItem->unit_price = prices::first()->unit_price_catalog;
                                $newOrderItem->sub_total = $newOrderItem->qty * $newOrderItem->unit_price;
                                $newOrderItem->save();
                                $iterator++;
                            }
                            return $newOrder->id;

                        });


                        if ($request->input('saveData') == "on") {
                            $customerUpdate = customers::find(Auth::user()->id ?? '');
                            $customerUpdate->default_payment_type = $request->input('payment');
                            $customerUpdate->address = $request->input('Morada');
                            $customerUpdate->nif = $request->input('NIF');
                            $customerUpdate->default_payment_ref = $customer->default_payment_ref ?? (Auth::user()->mail ?? '');
                            $customerUpdate->save();
                        }

                        $htmlMessage = "<strong>A sua encomenda foi concluida com sucesso: " . $total . "produto(s).</strong>";

                        $request->session()->forget('cart');
                        $request->session()->forget('itemCount');

                        // Send the email using the mail facade
                        Mail::to('noreply@demo.ainet.com'/*Auth::user()->email*/)->send(new MailSender($orderId));
                        
                        return view('carrinho.orderCompleted')->with('orderId' , $orderId);
                    }
                } else {
                    $htmlMessage = "Não existem produtos no carrinho.";
                }
            } catch (\Exception $error) {
                dd($error);
                $htmlMessage = "Não foi possível concluir a encomenda, porque ocorreu um erro!";
            }
            return back()
                ->with('message', $htmlMessage);
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }
}
