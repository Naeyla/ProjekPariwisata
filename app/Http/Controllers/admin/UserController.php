<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 🔹 MODAL EDIT (RETURN HTML)
    public function edit(User $user)
    {

    }

    // 🔹 UPDATE DARI MODAL
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'role'     => 'required'
        ]);

        $user->update($request->only('username', 'email', 'role'));

        return redirect()->route('managementadmin', ['tab' => 'users'])
                 ->with('success', 'User berhasil diupdate!');
    }

    // 🔹 FUNCTION LAMA TETAP AMAN
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