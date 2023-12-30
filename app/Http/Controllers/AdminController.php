<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile()
    {
        $id        = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function editProfile()
    {
        $id       = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function storeProfile(Request $request)
    {
        $id          = Auth::user()->id;
        $updatedUser = User::find($id);
        $updatedUser->name     = $request->name;
        $updatedUser->username = $request->username;
        $updatedUser->email    = $request->email;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('Y-m-d H-i') . ' - ' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $updatedUser->profile_image = $filename;
        }

        $updatedUser->save();

        return redirect()->route('admin.profile');
    }
}
