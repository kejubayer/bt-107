<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $creds = $request->except('_token');
        if (\auth()->attempt($creds)){
            if (\auth()->user()->role == 'admin'){
                return redirect()->route('dashboard');
            }
            session()->flash('message','Login Successful!');
            session()->flash('alert',"success");
            return redirect()->route('home');

        }
        session()->flash('message',"Invalid Credentials!");
        session()->flash('alert',"warning");
        return redirect()->back();
    }

    public function logout()
    {
        \auth()->logout();
        return redirect()->route('login');
    }

}
