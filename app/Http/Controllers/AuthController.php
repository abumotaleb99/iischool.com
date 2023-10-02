<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

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

    public function showForgotPasswordForm() {
        return view('backend.auth.forgot-password');
    }

    public function forgotPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $user = User::getUserByEmail($request->email);

        if(!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with("success", "Please check your email to reset password.");

        }else {
            return redirect()->back()->with("error", "This email doesn't exist. Enter a different email.");
        }

    }

    public function showResetPasswordForm($remember_token) {
        $user = User::getUserByToken($remember_token);

        if(!empty($user)) {
            return view('backend.auth.reset-password');

        }else {
            abort(404);
        }
    }

    public function resetPassword($remember_token, Request $request) {
        $this->validate($request, [
            'password' => 'required|min:6|max:20',
            'cpassword' => 'required|min:6|max:20',
        ]);

        if($request->password == $request->cpassword) {
            $user = User::getUserByToken($remember_token);

            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url('/'))->with("success", "Your password has been changed successfully.");

        }else {
            return redirect()->back()->with("error", "The password and confirm password don't match.");
        }
    }

    public function logout() {
        Auth::logout();

        return redirect(url('/'));
    }

}
