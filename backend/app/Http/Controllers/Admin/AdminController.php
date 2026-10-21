<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function checkAdminAccess()
    {
        if (app()->environment('local')) {
            return;
        }

        abort_unless(
            Auth::guard('admin')->check() &&
            strtolower(trim((string) Auth::guard('admin')->user()->role)) === 'admin',
            403,
            'Only admins can access this page.'
        );
    }

    private function findAdmin($id)
    {
        return Admin::findOrFail($id);
    }

    public function index()
    {
        $this->checkAdminAccess();

        $admins = Admin::latest()->get();

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

            'password' => [
                'nullable',
                'string',
                'confirmed',
            ],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

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

        if (
            Auth::guard('admin')->check() &&
            strtolower((string) Auth::guard('admin')->user()->email) ===
            strtolower((string) $admin->email)
        ) {
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
