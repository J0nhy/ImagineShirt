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
        $allTshirts = tshirt_images::paginate(10);
        //dump($allTshirts);
        Log::debug(
            'Tshirts has been loaded on the controller.',
            ['$allTshirts' => $allTshirts]
        );
        return view('catalogo.index')->with('tshirt_images', $allTshirts);
    }

    public function create(): View
    {
        $newTshirt = new tshirt_images();
        return view('catalogo.create')->withTshirt($newTshirt);
    }

    public function cart(): View
    {
        return view('catalogo.cart');
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
        return view('catalogo.show')->withTshirt($tshirt);
    }


}
