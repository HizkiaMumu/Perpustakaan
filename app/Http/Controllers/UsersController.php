<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{

    public function daftarUser(Request $request){
      $username = User::where('username', $request->username)->first();
      $email = User::where('email', $request->email)->first();
      if ($username != null) {
        return redirect()->back()->with("ERR", "Username sudah digunakan.");
      } elseif ($email != null) {
        return redirect()->back()->with("ERR", "Email sudah digunakan.");
      } else {
        $user = $request->all();
        $user['level'] = 1;
        $user['password'] = bcrypt($request->password);
        // dd($user);
        $createdUser = User::create($user);
        $authUser = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        return redirect("/admin")->with("OK", "Berhasil login.");
      }
    }

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
