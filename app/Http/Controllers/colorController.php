<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\colors;
use Illuminate\View\View;
use App\Http\Requests\CorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
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

        return view('admin.cores.show')->with('core', $core);
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

            $nome = $_POST['name'];
            $codigoCor = $_POST['colorValue'];
            //$imageUrl = basename($_FILES["imagem"]["name"]);
            $codigoCor = Str::remove('#', $codigoCor);
            $imageUrl = $codigoCor . '.png';
            //$imageUrl = basename($_FILES["Tshirt"]["name"]);
            //dd($nome, $codigoCor, $imageUrl);
            $imagem = $request->file('imagem');
            //dd($imagem);
            //dd($imagem);
            $path = $imagem->storeAs('tshirt_base', $imageUrl);

            $newCor = new colors();
            $newCor->name = $nome;
            $newCor->code = $codigoCor;
            //dd($newImage);
            $newCor->save();

            return redirect()->route('cores.index')->with('message', 'Estampa "' . $nome . '" guardada em ' . $path . '.');


    }
    public function destroy(colors $core): RedirectResponse
    {

            try{
                if($core != null){
                    colors::where('code',$core->code)->delete();
                }

                return redirect()->route('cores.index')->with('message', "Cor eliminada com sucesso.");

            } catch (\Throwable $th) {
                return redirect()->route('cores.index')->with('message', "ERRO: Não foi possivel eliminar a cor.");
            }

    }

    public function recover(string $cor): RedirectResponse
    {
        try{

            if(colors::where('code',$cor) != null){
                colors::where('code',$cor)->restore();
            }

            return redirect()->route('cores.index')->with('message', "Cor restaurada com sucesso.");

        } catch (\Throwable $th) {
            return redirect()->route('cores.index')->with('message', "ERRO: Não foi possivel restaurar a cor.");
        }



    }

}
