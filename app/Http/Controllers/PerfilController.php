<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class perfilController extends Controller
{
    public function index(Request $request): View
    {
        $user = users::where('id', '=', Auth::user()->id)->first();
        $customer = customers::where('id', '=', Auth::user()->id)->first();
        return view('perfil.index', compact('user', 'customer'));
    }

}
