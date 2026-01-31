<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => request('role')]);

        return back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }
}
