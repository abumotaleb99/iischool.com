<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login() {
        if(!empty(Auth::check())) {
            if(Auth::user()->role == 1) {
                return redirect('admin/dashboard');

            }elseif(Auth::user()->role == 2) {
                return redirect('teacher/dashboard');

            }elseif(Auth::user()->role == 3) {
                return redirect('student/dashboard');

            }elseif(Auth::user()->role == 4) {
                return redirect('parent/dashboard');
            }
        }
 
        return view('backend.auth.login');
    }

    public function authLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:20',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if(Auth::user()->role == 1) {
                return redirect('admin/dashboard');

            }elseif(Auth::user()->role == 2) {
                return redirect('teacher/dashboard');

            }elseif(Auth::user()->role == 3) {
                return redirect('student/dashboard');
                
            }elseif(Auth::user()->role == 4) {
                return redirect('parent/dashboard');
            }

        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
        
    }

    public function logout() {
        Auth::logout();

        return redirect(url('/'));
    }

}
