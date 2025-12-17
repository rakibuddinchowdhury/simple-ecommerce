<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    // 1. Show Profile Page
    public function index()
    {
        return view('frontend.users.profile');
    }

    // 2. Update Personal Details
    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:499',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->update();

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    // 3. Change Password
    public function changePassword()
    {
        return view('frontend.users.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        
        if($currentPasswordStatus){
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Password Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Current Password does not match');
        }
    }
}