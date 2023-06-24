<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\users;
use Database\Factories\UserFactory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(users::class, 'user');
    }
    public function index(Request $request): View
    {
        /*$allUsers = users::paginate(10);
        return view('admin.user.index')->with('users', $allUsers);*/

        $users = users::paginate(10);
        $usersTypes = users::all();
        $filterByType = $request->user_type ?? '';
        $filterByNome = $request->name ?? '';
        $filterByBlocked = $request->blocked ?? '';


        $userQuery = users::query();

        if ($filterByType !== '') {
            $userQuery->where('user_type', $filterByType);
        }

        if ($filterByNome !== '') {
            $users = users::where('name', 'like', "%$filterByNome%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $users);
        }
        if ($filterByBlocked !== '') {
            $userQuery->where('blocked', $filterByBlocked);
        }

        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $users = $userQuery->withTrashed()->paginate(10);

        return view('admin.user.index', compact(
            'filterByType',
            'users',
            'usersTypes',
            'filterByNome',
            'filterByBlocked'
        ));
    }
    public function show(users $user): View
    {

        return view('admin.user.show')->with('user', $user);
    }

    public function create(): View
    {
        //$this->authorize('create', CursoController::class);
        $newUser = new users();
        return view('admin.user.create')->withUser($newUser);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        //dd($request->hasFile('imagem'));
        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData, $request) {
            $newUser = new users();
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->user_type = $formData['tipo'];
            $newUser->password =  Hash::make($formData['password']);
            $newUser->save();

            if ($request->hasFile('imagem')) {
                $path = $request->imagem->store('public/photos');
                $newUser->photo_url = basename($path);
                $newUser->save();
            }


            return $newUser;
        });

        return redirect()->route('users.index')->with('message', 'User "' . $user->name . '" criado');
    }


    public function update(UserRequest $request, users $user): RedirectResponse
    {

        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData, $user, $request) {
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->user_type = $formData['tipo'];
            $user->save();
            if ($request->hasFile('imagem')) {
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->imagem->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }
            return $user;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "Docente <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');

        //$this->authorize('update', $curso);

        //dd($categoria);+
        /*
        $user->update(['user_type' => $request->tipo]);

        $user->update($request->validated());

        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>{$user->name}</a>
                        <strong>\"{$user->name}\"</strong> foi alterada com sucesso!";

        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');*/
    }

    public function edit(users $user): View
    {
        //$this->authorize('update', $curso);
        return view('admin.user.edit')->withUser($user);
    }

    public function destroy(users $user): RedirectResponse
    {

        try {
            if ($user != null) {
                users::where('id', $user->id)->delete();
            }

            return redirect()->route('users.index')->with('message', "User eliminado com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel eliminar a cor.");
        }
    }

    public function recover(string $user): RedirectResponse
    {
        try {

            if ($user != null) {
                users::where('id', $user)->restore();
            }

            return redirect()->route('users.index')->with('message', "User restaurado com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }
    }

    public function block(string $user): RedirectResponse
    {

        try {
            $userToChange = users::where('id', '=', $user)->first();


            if ($userToChange->deleted_at != null)
                return redirect()->back()->with('errorMessage', "Não podes alterar um user apagado");
            else
                $userToChange->blocked = 1;

            $userToChange->save();

            return redirect()->route('users.index')->with('message', "User restaurado com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }
    }

    public function unblock(string $user): RedirectResponse
    {
        try {
            $userToChange = users::where('id', '=', $user)->first();


            if ($userToChange->deleted_at != null)
                return redirect()->back()->with('errorMessage', "Não podes alterar um user apagado");
            else
                $userToChange->blocked = 0;

            $userToChange->save();

            return redirect()->route('users.index')->with('message', "User restaurado com sucesso.");
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }
    }
}
