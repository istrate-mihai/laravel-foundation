<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

        $notification = array(
            'message'    => 'Admin Successfully Logout.',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
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

        $notification = array(
            'message'    => 'Admin Profile Updated Successfully.',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword()
    {
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password'     => 'required',
            'new_password'     => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::id());

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password Updated Successfully.');
            return redirect()->back();
        }
        else {
            session()->flash('message', 'Old password is not match.');
            return redirect()->back();
        }
    }
}
