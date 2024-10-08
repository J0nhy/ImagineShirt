<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //$table_names = Schema::getColumnListing('tshirt_images');
        $tableName = 'tshirt_images';
        $columns = Schema::getColumnListing($tableName);

        $desiredColumns = ['name', 'description'];

        $filteredColumns = array_intersect($columns, $desiredColumns);


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
        if ($orderByCategoria !== '') {
            $tshirtQuery->orderBy($orderByCategoria, $orderByCategoriaAscDesc);
        }
        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $tshirts = $tshirtQuery->whereNull('customer_id')->paginate(16);
        $imagensPrivadas = tshirt_images::where('customer_id', '=', Auth::user()->id ?? '')->paginate(16);

        return view('catalogo.index', compact(
            'tshirts',
            'imagensPrivadas',
            'filterByNome',
            'filterByDescricao',
            'filterByCategoria',
            'categorias',
            'filteredColumns',
            'orderByCategoria',
            'orderByCategoriaAscDesc'
        ));
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
    public function show(String $tshirt): View
    {
        //dd(strtok($tshirt, '-'));
        $tshirt = tshirt_images::findOrFail(strtok($tshirt, '-'));
        $allTshirts = tshirt_images::all();
        $allColors = colors::all();

        return view('catalogo.show', compact('tshirt', 'allColors'));
    }

    public function uploadEstampa(Request $request): RedirectResponse
    {

        try {

            $nome = $_POST['NomeEstampa'];
            $descricao = $_POST['DescricaoEstampa'];
            $imageUrl = basename($_FILES["Estampa"]["name"]);
            //dd($nome, $descricao, $imageUrl);

            $imageUrl = str_replace(" ", "_", $imageUrl);

            $imagem = $request->file('Estampa');
            $path = $imagem->storeAs('public/tshirt_images', $imageUrl);

            $newImage = new tshirt_images();
            $newImage->name = $nome;
            $newImage->description = $descricao;
            $newImage->image_url = $imageUrl;
            if (Auth::user()->user_type == 'C') {
                $newImage->customer_id = Auth::user()->id ?? '';
            } else {
                $newImage->category_id = $nome = $_POST['categoriaEstampa'] ?? '';
            }

            $newImage->save();

            return redirect()->back()->with('message', 'Estampa "' . $nome . '" guardada em ' . $path . '.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', "Estampa não guardada. ERRO: " . $th . ".");
        }
    }
    public function edit(Request $request): View
    {
        if (!Auth::user()) {
            return abort(403, 'This action is Unauthorized');
        } else {
            if (Auth::user()->user_type != 'E') {
                if (Auth::user()->user_type == 'C') {
                    $tshirts = tshirt_images::where('customer_id', '=', Auth::user()->id ?? '')->get();
                    return view('catalogo.edit')->with('tshirts', $tshirts);
                } else {
                    $tableName = 'tshirt_images';
                    $columns = Schema::getColumnListing($tableName);

                    $desiredColumns = ['name', 'description'];

                    $filteredColumns = array_intersect($columns, $desiredColumns);

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
                    if ($orderByCategoria !== '') {
                        $tshirtQuery->orderBy($orderByCategoria, $orderByCategoriaAscDesc);
                    }
                    // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
                    $tshirts = $tshirtQuery->whereNull('customer_id')->paginate(16);
                    $imagensPrivadas = tshirt_images::where('customer_id', '=', Auth::user()->id ?? '')->paginate(16);

                    return view('catalogo.edit', compact(
                        'tshirts',
                        'imagensPrivadas',
                        'filterByNome',
                        'filterByDescricao',
                        'filterByCategoria',
                        'categorias',
                        'filteredColumns',
                        'orderByCategoria',
                        'orderByCategoriaAscDesc'
                    ));
                }
            } else {
                return abort(403, 'This action is Unauthorized');
            }
        }
    }

    public function editarEstampa(): RedirectResponse
    {
        try {
            $id = $_POST['updateIdEstampa'];
            $nome = $_POST['updateNomeEstampa'];
            $descricao = $_POST['updateDescricaoEstampa'];

            $estampa = tshirt_images::find($id);

            $estampa->name = $nome;
            $estampa->description = $descricao;
            if (Auth::user()->user_type == 'A') {
                $estampa->category_id = $_POST['updatecategoriaEstampa'] ?? '';
            }

            $estampa->save();

            return redirect()->back()->with('message', "Imagem atualizada para: " . $nome . ".");
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', "ERRO: Não foi possivel atualizar a Imagem: " . $nome . ".");
        }
    }

    public function removerEstampa($id): RedirectResponse
    {
        try {

            $estampa = tshirt_images::find($id);

            if ($estampa != null) {
                tshirt_images::where('id', $id)->delete();
            }

            return redirect()->back()->with('message', "Imagem eliminada com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', "ERRO: Não foi possivel eliminar a Imagem.");
        }
    }
}
