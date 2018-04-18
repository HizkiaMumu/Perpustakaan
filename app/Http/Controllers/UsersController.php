<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{

    public function Auth(Request $request){
      $user = User::where('username', $request->username)->first();
      if ($user != null) {
        $validUser = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if ($validUser) {
          return redirect('/admin')->with('OK', 'Berhasil Login.');
        } else {
          return redirect()->back()->with('ERR', 'Password yang anda masukan salah.');
        }
      } else {
        return redirect()->back()->with('ERR', 'Username yang anda masukan salah.');
      }
    }

    public function logout(){
      $user = Auth::logout();
      return redirect()->back()->with('OK', 'Berhasil Logout.');
    }

}
