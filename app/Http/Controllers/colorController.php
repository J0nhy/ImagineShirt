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
}
