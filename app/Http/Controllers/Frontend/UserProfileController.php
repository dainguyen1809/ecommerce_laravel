<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user()
            ->fill($request->validated());

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
