<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\colors;
use Illuminate\View\View;
use App\Http\Requests\CorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
//soft deletes
use Illuminate\Database\Eloquent\SoftDeletes;



class colorController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(colors::class, 'core');
    }

    public function index(): View
    {
        $allColors = colors::withTrashed()->paginate(10);
        return view('admin.cores.index')->with('cores', $allColors);
    }

    public function show(colors $core): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);

        return view('admin.cores.show')->with('cor', $core);
        //return view('admin.cores.show', compact('cores'));
    }

    public function edit(colors $cor): View
    {
        //$this->authorize('update', $curso);
        return view('admin.cores.edit')->withCor($cor);
    }

    public function create(): View
    {
        //$this->authorize('create', CursoController::class);
        $newCor = new colors();
        return view('admin.cores.create')->withCor($newCor);
    }

    public function store(CorRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        $cor = DB::transaction(function () use ($formData, $request) {
            $newCor = new colors();
            $codigo = trim($formData['colorValue'], '#');
            $newCor->code = $codigo;
            $newCor->name = $formData['name'];
            $newCor->save();

            if ($request->hasFile('imagem')) {
                $imageName = $codigo . '.' . $request->imagem->getClientOriginalExtension();
                $path = $request->imagem->storeAs('public/tshirt_base', $imageName);

                $newCor->save();
            }
            return $newCor;
        });

        return redirect()->route('cores.index')->with('message', 'User "' . $cor->name . '" criado');
    }
    public function destroy(colors $core): RedirectResponse
    {

        try {
            if ($core != null) {
                colors::where('code', $core->code)->delete();
            }

            return redirect()->route('cores.index')->with('message', "Cor eliminada com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('cores.index')->with('message', "ERRO: Não foi possivel eliminar a cor.");
        }
    }

    public function recover(string $cor): RedirectResponse
    {
        try {

            if (colors::where('code', $cor) != null) {
                colors::where('code', $cor)->restore();
            }

            return redirect()->route('cores.index')->with('message', "Cor restaurada com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('cores.index')->with('message', "ERRO: Não foi possivel restaurar a cor.");
        }
    }
}
