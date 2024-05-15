<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('admin.register', [
            'title' => 'register'
        ]);
    }


    public function store(Request $request){
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:dns',
            'password'=> 'required|min:8|max:18'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        $request->session()->flash('status', 'Registrasi Berhasil');

        return redirect('/login');
    }
}
