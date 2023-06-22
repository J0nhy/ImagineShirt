<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\colors;
use App\Models\orders;

class adminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(orders::class, 'order');
    }
    public function index(): View
    {
        return view('admin.index');
    }
}
