<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\tshirt_images;
use App\Models\colors;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


class tshirt_imagesController extends Controller
{
    public function index(Request $request): View
    {
        $table_names = Schema::getColumnListing('tshirt_images');



        $categorias = Category::all();
        $filterByCategoria = $request->categoria ?? '';

        $orderByCategoria = $request->categoriaOrder ?? '';
        $orderByCategoriaAscDesc = $request->categoriaOrderAscDesc ?? '';

        $filterByNome = $request->nome ?? '';
        $filterByDescricao = $request->descricao ?? '';

        $tshirtQuery = tshirt_images::query();


        if ($filterByCategoria !== '') {
            $tshirtQuery->where('category_id', $filterByCategoria);
        }
        if ($filterByNome !== '') {
            $tshirtIds = tshirt_images::where('name', 'like', "%$filterByNome%")->pluck('id');
            $tshirtQuery->whereIntegerInRaw('id', $tshirtIds);
        }
        if ($filterByDescricao !== '') {
            $tshirtIds = tshirt_images::where('description', 'like', "%$filterByDescricao%")->pluck('id');
            $tshirtQuery->whereIntegerInRaw('id', $tshirtIds);
        }
        //order by categoria
        if($orderByCategoria !== ''){
            $tshirtQuery->orderBy($orderByCategoria, $orderByCategoriaAscDesc);
        }
        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $tshirts = $tshirtQuery->whereNull('customer_id')->paginate(16);
        return view('catalogo.index', compact('tshirts', 'filterByNome', 'filterByDescricao',
                    'filterByCategoria', 'categorias', 'table_names', 'orderByCategoria', 'orderByCategoriaAscDesc'));
    }

    public function admin(Request $request): View
    {
        $table_names = Schema::getColumnListing('tshirt_images');

        return view('admin.index', compact('table_names'));
    }

    public function create(): View
    {
        $newTshirt = new tshirt_images();
        return view('catalogo.create')->withTshirt($newTshirt);
    }

    public function store(Request $request): RedirectResponse
    {
        tshirt_images::create($request->all());
        return redirect()->route('catalogo.index');
    }
    public function edit(tshirt_images $tshirt): View
    {
        return view('catalogo.edit')->withTshirt($tshirt);
    }
    public function update(Request $request, tshirt_images $tshirt): RedirectResponse
    {
        $tshirt->update($request->all());
        return redirect()->route('catalogo.index');
    }
    public function destroy(tshirt_images $tshirt): RedirectResponse
    {
        $tshirt->delete();
        return redirect()->route('catalogo.index');
    }
    public function show(tshirt_images $tshirt): View
    {
        $allTshirts = tshirt_images::all();
        $allColors = colors::all();

        return view('catalogo.show', compact('tshirt', 'allColors'));

    }


}
