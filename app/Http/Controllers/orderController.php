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
}
