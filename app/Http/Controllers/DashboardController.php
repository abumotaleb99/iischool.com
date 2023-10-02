<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        $data['header_title'] = 'Dashboard';

        if(Auth::user()->role == 1) {
            return view('backend.admin.dashboard', $data);

        }elseif(Auth::user()->role == 2) {
            return view('backend.teacher.dashboard', $data);

        }elseif(Auth::user()->role == 3) {
            return view('backend.student.dashboard', $data);

        }elseif(Auth::user()->role == 4) {
            return view('backend.parent.dashboard', $data);
        }

    }

    public function adminList() {
        return view('backend.admin.admin.list');
    }

}
