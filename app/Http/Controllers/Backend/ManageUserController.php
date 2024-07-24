<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CreateAccount;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('admin.manage-user.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed',
            'role' => 'required',
        ]);

        $user = new User();

        if ($request->role === 'user') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->status = 'active';
            $user->save();

            Mail::to($request->email)->send(new CreateAccount($request->name, $request->email, $request->password));

            toastr('Created Successfully', 'success');
            return redirect()->back();
        } else if ($request->role === 'vendor') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'vendor';
            $user->status = 'active';
            $user->save();

            Mail::to($request->email)->send(new CreateAccount($request->name, $request->email, $request->password));

            toastr('Created Successfully', 'success');
            return redirect()->back();
        } else if ($request->role === 'admin') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            Mail::to($request->email)->send(new CreateAccount($request->name, $request->email, $request->password));

            toastr('Created Successfully', 'success');
            return redirect()->back();
        }
    }
}
