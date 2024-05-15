<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //

    public function index(){
        return view('admin.login', [
            'title' => 'login'
        ]);
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password'=> 'required|min:8|max:18'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->with('invalid', 'Login Gagal!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');


    }
}
