<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class AdminPagesController extends Controller
{

    public function login(){
      return view('dashboard/login');
    }

    public function halamanBuku(){
      $data['buku'] = Buku::all();
      return view('dashboard/buku', $data);
    }

}
