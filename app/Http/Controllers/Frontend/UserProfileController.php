<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100'],
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            if (File::exists(public_path($user->avatar))) {
                File::delete(public_path($user->avatar));
            }
            $avt = $request->avatar;
            $avtName = rand() . '_' . $avt->getClientOriginalName();
            $avt->move(public_path('images/users'), $avtName);
            $path = '/images/users/' . $avtName;
            $user->avatar = $path;
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        toastr()->success('Update Successfully');

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->validated();

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->warning('You have just changed the password');
        toastr()->success('Update Successfully');
        return redirect()->back();
    }
}
