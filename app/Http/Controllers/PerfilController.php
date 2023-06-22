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
        if (!Auth::user() || Auth::user()->user_type == 'A' || Auth::user()->user_type == 'C') {
            if (!Auth::user()) {
                return view('welcome');
            }
            $user = users::where('id', '=', Auth::user()->id)->first();
            $customer = customers::where('id', '=', Auth::user()->id)->first();
            return view('perfil.index', compact('user', 'customer'));
        } else {
            return abort(403, 'This action is Unauthorized');
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {

            DB::transaction(function () use ($request) {
                $newUserInfo = users::find(Auth::user()->id);
                $newUserInfo->name = $request->input('Nome') ?? $newUserInfo->name;
                $newUserInfo->email = $request->input('Email') ?? $newUserInfo->email;
                $newUserInfo->password = $newUserInfo->password;
                if ($imageUrl = basename($_FILES["foto"]["name"])) {
                    $imageUrl = str_replace(" ", "_", $imageUrl);
                    $imagem = $request->file('foto');
                    $imagem->storeAs('photos', $imageUrl);
                } else {
                    $imageUrl = NULL;
                }
                $newUserInfo->photo_url = $imageUrl ?? $newUserInfo->photo_url;

                $newUserInfo->save();

                $newCustomerInfo = customers::find(Auth::user()->id);
                $newCustomerInfo->nif = $request->input('NIF') ?? NULL;
                $newCustomerInfo->address = $request->input('Morada') ?? NULL;
                if (($request->input('payment') ?? '') == "Nenhum") {
                    $newCustomerInfo->default_payment_type = NULL;
                    $newCustomerInfo->default_payment_ref = NULL;
                } else {
                    $newCustomerInfo->default_payment_type = $request->input('payment') ?? $newCustomerInfo->default_payment_type;
                    $newCustomerInfo->default_payment_ref = $request->input('payment') ? Auth::user()->email : $newCustomerInfo->default_payment_ref;
                }

                $newCustomerInfo->save();
            });

            return redirect()->back()->with('message', "Perfil atualizado com sucesso");
        } catch (\Exception $error) {
            dd($error);
            return redirect()->back()->with('message', "Não foi possível atualizar o perfil, porque ocorreu um erro!");
        }
    }

    public function desativa(Request $request): RedirectResponse
    {
        try {

            $conta = users::find(Auth::user()->id);

            if ($conta != null) {
                users::where('id', $conta->id)->delete();
            }

            return redirect()->back()->with('message', "Conta removida com sucesso");
        } catch (\Exception $error) {
            dd($error);
            return redirect()->back()->with('message', "Não foi possível remover a sua conta, porque ocorreu um erro!");
        }
    }
}
