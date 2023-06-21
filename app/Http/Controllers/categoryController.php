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
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'categoria');
    }

    public function index(): View
    {
        $allCategorias = Category::withTrashed()->paginate(10);
        return view('admin.categoria.index')->with('categorias', $allCategorias);
    }

    public function show(String $categoria): View
    {
        //dd(strtok($categoria, '-'));
        $categoria = Category::findOrFail(strtok($categoria, '-'));

        return view('admin.categoria.show')->with('categoria', $categoria);
    }

    public function create(): View
    {
        //$this->authorize('create', CursoController::class);
        $newCategoria = new Category();
        return view('admin.categoria.create')->withCategoria($newCategoria);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {


            $nome = $_POST['name'];

            $newCategoria = new Category();
            $newCategoria->name = $nome;
            //dd($newImage);
            $newCategoria->save();

            return redirect()->route('categorias.index');


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

    }

    public function destroy(string $categoria): RedirectResponse
    {

            try{

                $categoriaAEliminar = Category::find($categoria);

                if($categoriaAEliminar != null){
                    Category::where('id',$categoria)->delete();
                }

                return redirect()->route('categorias.index')->with('message', "Categoria eliminada com sucesso.");

            } catch (\Throwable $th) {
                return redirect()->route('categorias.index')->with('message', "ERRO: Não foi possivel eliminar a categoria.");
            }

    }

    public function recover(string $categoria): RedirectResponse
    {
        try{

            if(Category::where('id',$categoria) != null){
                Category::where('id',$categoria)->restore();
            }

            return redirect()->route('categorias.index')->with('message', "Categoria restaurada com sucesso.");

        } catch (\Throwable $th) {
            return redirect()->route('categorias.index')->with('message', "ERRO: Não foi possivel restaurar a categoria.");
        }



    }

}
