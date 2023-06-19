<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\View\View;


class userController extends Controller
{
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
}
