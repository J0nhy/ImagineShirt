<?php

namespace App\Http\Controllers;

use App\Models\colors;
use App\Models\orders;
use App\Models\order_items;
use App\Models\tshirt_images;
use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class pedidosController extends Controller
{
    public function index(Request $request): View
    {
        if (Auth::user()->user_type == 'C') {
            $orders = orders::where('customer_id', '=', Auth::user()->id)->get();
            return view('pedidos.orders')->with('orders', $orders);
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function viewOrder(Request $request, $id): View
    {
        if (Auth::user()->user_type == 'C') {
            $products = order_items::where('order_id', '=', $id)->get();
            $imageId = order_items::where('order_id', '=', $id)->pluck('tshirt_image_id');
            $colorCode = order_items::where('order_id', '=', $id)->pluck('color_code');

            $image = tshirt_images::whereIn('id', $imageId)->withTrashed()->get();
            $cor = colors::whereIn('code', $colorCode)->withTrashed()->pluck("name");

            $iterator = 0;
            foreach ($products as $produto) {
                $produtos[$produto->id] = array(
                    "image_url" => $image[$iterator]["image_url"],
                    "name" => $image[$iterator]["name"],
                    "cor" => isset($cor[$iterator]) ?  $cor[$iterator] : 'null',
                    "colorCode" => isset($colorCode) ?  $colorCode[0] : 'null',
                    "size" => $produto->size,
                    "id" => $produto->id,
                    "qtd" => $produto->qty,
                    "price" => $produto->unit_price,
                    "subTotal" => $produto->sub_total,
                );
                $iterator++;
            }

            return view('pedidos.orderDetails')->with('produtos', $produtos);
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }
}
