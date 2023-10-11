<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash; 

class UserController extends Controller
{
    public function showChangePasswordForm() {
        $data['header_title'] = 'Change Password';

        return view('backend.profile.change-password', $data);
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:20',
            'confirm_new_password' => 'required|min:6|max:20',
        ]);

        $user = User::getSingleUserById(Auth::user()->id);

        if(Hash::check($request->current_password, $user->password)) {
            if($request->new_password == $request->confirm_new_password) {
                $user->password = Hash::make($request->new_password);
                $user->save();

            }else {
                return redirect()->back()->with("error", "The new password and confirm password don't match.");
            }       

            return redirect()->back()->with("success", "Your password has been changed successfully.");
        }else {
            return redirect()->back()->with("error",  "Your current password don't match.");
        }
    }
}
