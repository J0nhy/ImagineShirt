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

            $nome = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $tipo = $_POST['tipo'];
            //$imageUrl = basename($_FILES["imagem"]["name"]);
            $newUser = new users();
            if($_FILES["imagem"]["name"] == ""){


            }else{
                $imageUrl = basename($_FILES["imagem"]["name"]);

                $imageUrl = str_replace(" ", "_", $imageUrl);

                $imagem = $request->file('imagem');
                $path = $imagem->storeAs('photos', $imageUrl);

                $imagem = $request->file('imagem');

                $path = $imagem->storeAs('tshirt_base', $imageUrl);
                $newUser->photo_url = $imageUrl;
            }
            //$imageUrl = basename($_FILES["Tshirt"]["name"]);
            //dd($nome, $codigoCor, $imageUrl);



            $newUser->name = $nome;
            $newUser->email = $email;
            $newUser->user_type = $tipo;

             // password is form field
            $hashed = Hash::make($password);
            $newUser->password = $hashed;




            //dd($newImage);
            $newUser->save();

            return redirect()->route('users.index')->with('message', 'Estampa "' . $nome . '" guardada em ' . '.');


    }


    public function update(UserRequest $request, users $user): RedirectResponse
    {
        //$this->authorize('update', $curso);

        //dd($categoria);+
        $user->update(['user_type' => $request->tipo]);
        $user->update($request->validated());

        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>{$user->name}</a>
                        <strong>\"{$user->name}\"</strong> foi alterada com sucesso!";

        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');

    }

    public function edit(users $user): View
    {
        //$this->authorize('update', $curso);
        return view('admin.user.edit')->withUser($user);
    }

    public function destroy(users $user): RedirectResponse
    {

            try{
                if($user != null){
                    users::where('id',$user->id)->delete();
                }

                return redirect()->route('users.index')->with('message', "User eliminado com sucesso.");

            } catch (\Throwable $th) {
                return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel eliminar a cor.");
            }

    }

    public function recover(string $user): RedirectResponse
    {
        try{

            if($user != null){
                users::where('id',$user)->restore();
            }

            return redirect()->route('users.index')->with('message', "User restaurado com sucesso.");

        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }



    }

    public function block(string $user): RedirectResponse
    {

        try{
            $userToChange = users::where('id','=' ,$user)->first();


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
        try{
            $userToChange = users::where('id','=' ,$user)->first();


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
