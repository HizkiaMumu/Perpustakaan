<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{

    public function login(){
      return view('dashboard/login');
    }

    public function home(){
      return view('dashboard/home');
    }

}
