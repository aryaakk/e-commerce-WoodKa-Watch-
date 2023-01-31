<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function timepiece()
    {
        return view('users.timepiece');
    }
}
