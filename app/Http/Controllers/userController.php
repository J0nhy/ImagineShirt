<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\View\View;


class userController extends Controller
{
    public function index(): View
    {
        $allUsers = users::paginate(10);
        return view('admin.user.index')->with('users', $allUsers);
    }
}
