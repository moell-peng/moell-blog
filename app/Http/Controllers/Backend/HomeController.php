<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        /*$user = Auth::user();
        return view('backend.home', compact('user'));*/
        return view('backend.home');
    }
}
