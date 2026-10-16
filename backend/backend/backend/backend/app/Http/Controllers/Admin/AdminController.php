<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function checkAdminAccess()
    {
        if (app()->environment('local')) {
            return;
        }

        abort_unless(
            Auth::check() &&
            strtolower(trim((string) Auth::user()->role)) === 'admin',
            403,
            'Only admins can access this page.'
        );
    }

    private function findAdmin($id)
    {
        return User::whereRaw('LOWER(role) = ?', ['admin'])
            ->findOrFail($id);
    }

    public function index()
    {
        $this->checkAdminAccess();

        $admins = User::whereRaw('LOWER(role) = ?', ['admin'])
            ->latest()
            ->get();

        return view('admin.admins', compact('admins'));
    }

    public function edit($id)
    {
        $this->checkAdminAccess();

        $admin = $this->findAdmin($id);

        return view('admin.admin-edit', compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $this->checkAdminAccess();

        $admin = $this->findAdmin($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],

            'password' => [
                'nullable',
                'string',
                'confirmed',
            ],
        ]);

        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password only when a new password is entered
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin details updated successfully.');
    }


    public function destroy($id)
    {
        $this->checkAdminAccess();

        $admin = $this->findAdmin($id);

        if ($admin->id == Auth::id()) {
            return redirect()
                ->route('admins.index')
                ->with('error', 'You cannot delete your own admin account.');
        }

        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully.');
    }
}
