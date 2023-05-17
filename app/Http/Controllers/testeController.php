<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tshirt_image;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class testeController extends Controller
{
    public function index(): View
    {
        $allTshirts = Tshirt_image::all();
        //dump($allTshirts);
        Log::debug(
            'Tshirts has been loaded on the controller.',
            ['$allTshirts' => $allTshirts]
        );
        return view('teste.index')->with('Tshirt_images', $allTshirts);
    }

    public function create(): View
    {
        $newTshirt = new Tshirt_image();
        return view('teste.create')->withTshirt($newTshirt);
    }
    public function store(Request $request): RedirectResponse
    {
        Tshirt_image::create($request->all());
        return redirect()->route('teste.index');
    }
    public function edit(Tshirt_image $tshirt): View
    {
        return view('teste.edit')->withTshirt($tshirt);
    }
    public function update(Request $request, Tshirt_image $tshirt): RedirectResponse
    {
        $tshirt->update($request->all());
        return redirect()->route('teste.index');
    }
    public function destroy(Tshirt_image $tshirt): RedirectResponse
    {
        $tshirt->delete();
        return redirect()->route('teste.index');
    }
    public function show(Tshirt_image $tshirt): View
    {
        return view('teste.show')->withTshirt($tshirt);
    }


}
