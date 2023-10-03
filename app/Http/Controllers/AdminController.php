<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function adminList() {
        $data['header_title'] = 'Admin List';
        $data['adminUsers'] = User::getAllAdminUsers();

        return view('backend.admin.admin.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Admin New Admin';

        return view('backend.admin.admin.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|max:20',
        ]);

        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 1;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('admin/admin/list')->with("success", "Admin added successfully.");
    }

    
    public function edit($id) {
        $data['adminUser'] = User::getSingleAdminUserById($id);

        if(!empty($data['adminUser'])) {
            $data['header_title'] = 'Edit Admin';

            return view('backend.admin.admin.edit', $data);
        }else {
            abort(404);
        }

    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::getSingleAdminUserById($request->id);

        
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/admin/list')->with("success", "Admin updated successfully.");
    }

    public function delete($id) {
        $user = User::getSingleAdminUserById($id);

        if(!empty($user)) {
            $user->delete();
        }else {
            abort(404);
        }

        return redirect('admin/admin/list')->with("success", "Admin delete successfully.");

    }

}
