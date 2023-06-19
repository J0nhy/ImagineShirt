<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\View\View;


class orderController extends Controller
{
    public function index(): View
    {
        $allEncomendas = orders::paginate(10);
        return view('admin.encomendas.index')->with('encomendas', $allEncomendas);
    }

    public function show(string $order): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);

        $order =orders::findOrFail(strtok($order));
        return view('admin.encomendas.show', compact('order'));
        //return view('admin.cores.show', compact('cores'));
    }
}
