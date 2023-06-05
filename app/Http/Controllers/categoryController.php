<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;


class categoryController extends Controller
{
    public function index(): View
    {
        $allCategorias = Category::paginate(10);
        return view('admin.categoria.index')->with('categorias', $allCategorias);
    }
}
