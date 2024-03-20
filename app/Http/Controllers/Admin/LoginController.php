<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('layouts.login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:4',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
//            \toastr()->success('Login successfully :)','Success');
            return redirect() -> route('dashboard')->with('success', 'Login has been successfully');
        }else {
//            \toastr()->error('fail, WRONG USERNAME OR PASSWORD :)','Error');
            return redirect()->route('login')->with('error', 'WRONG USERNAME OR PASSWORD');
        }
    }

    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();
//        \toastr()->success('Logout successfully :)','Success');
        return redirect()->route('login');
    }

    private function getGaurd()
    {
        return auth('admin');
    }
}
