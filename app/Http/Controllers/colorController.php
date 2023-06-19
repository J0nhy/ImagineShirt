<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\colors;
use Illuminate\View\View;


class colorController extends Controller
{
    public function index(): View
    {
        $allColors = colors::paginate(10);
        return view('admin.cores.index')->with('cores', $allColors);
    }

    public function show(string $cor): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);

        $cor =colors::findOrFail(strtok($cor));
        return view('admin.cores.show', compact('cor'));
        //return view('admin.cores.show', compact('cores'));
    }

    public function edit(colors $cor): View
    {
        //$this->authorize('update', $curso);
        return view('admin.cores.edit')->withCor($cor);
    }
}
