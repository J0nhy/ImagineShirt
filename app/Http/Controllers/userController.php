<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\users;
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

        $userQuery = users::query();

        if ($filterByType !== '') {
            $userQuery->where('user_type', $filterByType);
        }

        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $users = $userQuery->paginate(10);

        return view('admin.user.index', compact(
            'filterByType',
            'users',
            'usersTypes'
        ));

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
             // password is form field
            $hashed = Hash::make($password);
            $newUser->password = $hashed;




            //dd($newImage);
            $newUser->save();

            return redirect()->route('users.index')->with('message', 'Estampa "' . $nome . '" guardada em ' . '.');


    }

    public function show(string $user): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);

        $user =users::findOrFail($user);
        return view('admin.user.show', compact('user'));
        //return view('admin.cores.show', compact('cores'));
    }

    public function edit(users $user): View
    {
        //$this->authorize('update', $curso);
        return view('admin.users.edit')->withUser($user);
    }

    public function destroy(string $user): RedirectResponse
    {

            try{

                $userEliminar = users::find($user);

                if($userEliminar != null){
                    users::where('id',$user)->delete();
                }

                return redirect()->route('users.index')->with('message', "User eliminado com sucesso.");

            } catch (\Throwable $th) {
                return redirect()->route('users.index')->with('message', "ERRO: Não foi possivel eliminar a cor.");
            }

    }
}
