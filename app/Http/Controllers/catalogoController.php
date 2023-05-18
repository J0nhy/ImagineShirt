<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tshirt_images;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class catalogoController extends Controller
{
    public function index(): View
    {
        $allTshirts = tshirt_images::all();
        //dump($allTshirts);
        Log::debug(
            'Tshirts has been loaded on the controller.',
            ['$allTshirts' => $allTshirts]
        );
        return view('catalogo.index')->with('tshirt_images', $allTshirts);
    }

    public function create(): View
    {
        $newTshirt = new Tshirt();
        return view('catalogo.create')->withTshirt($newTshirt);
    }
    public function store(Request $request): RedirectResponse
    {
        tshirt::create($request->all());
        return redirect()->route('catalogo.index');
    }
    public function edit(Tshirt $tshirt): View
    {
        return view('catalogo.edit')->withTshirt($tshirt);
    }
    public function update(Request $request, Tshirt $tshirt): RedirectResponse
    {
        $tshirt->update($request->all());
        return redirect()->route('catalogo.index');
    }
    public function destroy(Tshirt $tshirt): RedirectResponse
    {
        $tshirt->delete();
        return redirect()->route('catalogo.index');
    }
    public function show(Tshirt $tshirt): View
    {
        return view('catalogo.show')->withTshirt($tshirt);
    }


}
