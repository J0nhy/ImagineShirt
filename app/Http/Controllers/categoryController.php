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
        /*
        $newCategoria = Category::create($request->validated());
        $url = route('admin.categorias.create', ['categoria' => $newCategoria]);
        $htmlMessage = "Categoria <a href='$url'>{$newCategoria->nome}</a>
                        <strong>\"{$newCategoria->nome}\"</strong> foi criado com sucesso!";
        return redirect()->route('admin.categorias.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
        */

            $nome = $_POST['name'];

            $newCategoria = new Category();
            $newCategoria->name = $nome;
            //dd($newImage);
            $newCategoria->save();

            return redirect()->route('categorias.index');


    }
    public function show(String $categoria): View
    {
        //dd(strtok($categoria, '-'));
        $categoria = Category::findOrFail(strtok($categoria, '-'));

        return view('admin.categoria.show', compact('categoria'));
    }

    public function edit(Category $categoria): View
    {
        //$this->authorize('update', $curso);
        return view('admin.categoria.edit')->withCategoria($categoria);
    }

    public function update(CategoryRequest $request, Category $categoria): RedirectResponse
    {
        //$this->authorize('update', $curso);
        //dd($categoria);
        $categoria->update($request->validated());
        $url = route('categorias.show', ['categoria' => $categoria]);
        $htmlMessage = "Curso <a href='$url'>{$categoria->name}</a>
                        <strong>\"{$categoria->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('categorias.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
            /*
            $formData = $request->validated();
            $category = DB::transaction(function () use ($formData, $categoria, $request) {
                $categoria->name = $formData['inputNome'];
                $categoria->save();
                return $categoria;
            });
            $url = route('admin.categorias.show', ['categoria' => $categoria]);
            $htmlMessage = "Category <a href='$url'>{$category->name}</a> foi alterada com sucesso!";
            return redirect()->route('admin.categorias.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
            */
            /*
            @dump($categoria);
            $category = Category::where('name', '=', $categoria->name )->first();
            if ($category) {
                $category->name = $request->input('inputNome');
                dd($category);
                $category->save();

            }*/

    }

}
