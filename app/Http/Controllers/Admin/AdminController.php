<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {

        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = 'Admin';
        return view('admin.admin.list', $data);

    }

    public function add()
    {

        $data['header_title'] = 'Add New Admin';
        return view('admin.admin.add', $data);

    }
    public function insert(Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->email);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin Succefully Created');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = 'Edit Admin';
        return view('admin.admin.edit', $data);
    }

    public function update(Request $request, $id)
    {

        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->email);
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin Succefully Updated');
    }
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success', 'Record Succefully Deleted');
    }
    public function customer_list()
    {
        $data['getRecord'] = User::getCustomer();
        $data['header_title'] = 'Customer';
        return view('admin.customer.list', $data);
    }


}
