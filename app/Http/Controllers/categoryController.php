<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function index(): View
    {
        $allCategorias = Category::paginate(10);
        return view('admin.categoria.index')->with('categorias', $allCategorias);
    }

    public function create(): View
    {
        //$this->authorize('create', CursoController::class);
        $newCategoria = new Category();
        return view('admin.categoria.create')->withCategoria($newCategoria);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        //$this->authorize('create', CursoController::class);

        $newCategoria = Category::create($request->validated());
        $url = route('admin.categorias.create', ['categoria' => $newCategoria]);
        $htmlMessage = "Categoria <a href='$url'>{$newCategoria->nome}</a>
                        <strong>\"{$newCategoria->nome}\"</strong> foi criado com sucesso!";
        return redirect()->route('admin.categorias.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');

    }
}
