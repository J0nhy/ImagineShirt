<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\View\View;


class orderController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(orders::class, 'order');
    }

    public function index(Request $request): View
    {
        //$allEncomendas = orders::paginate(10);
        //return view('admin.encomendas.index')->with('encomendas', $allEncomendas);

        $encomendas = orders::paginate(10);
        $allOrders = orders::all();
        $filterByStatus = $request->status ?? '';
        $filterByCostumerID = $request->CostumerID ?? '';


        $orderQuery = orders::query();

        if ($filterByStatus !== '') {
            $orderQuery->where('status', $filterByStatus);
        }

        if ($filterByCostumerID !== '') {
            $encomendas = orders::where('customer_id', 'like', "%$filterByCostumerID%")->pluck('id');
            $orderQuery->whereIntegerInRaw('id', $encomendas);
        }

        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $encomendas = $orderQuery->paginate(10);

        return view('admin.encomendas.index', compact(
            'filterByStatus',
            'encomendas',
            'allOrders',
            'filterByCostumerID'
        ));

    }


    public function show(orders $order): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);


        $order =orders::findOrFail($order);
        return view('admin.encomendas.show', compact('order'));
        //return view('admin.cores.show', compact('cores'));

    }
}
