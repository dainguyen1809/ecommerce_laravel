<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index()
    {
        $userAddress = UserAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.address.index', [
            'userAddress' => $userAddress,
        ]);
    }

    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:user_addresses,email'],
            'phone' => ['required', 'max:20', 'unique:user_addresses,phone'],
            'country' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'zipcode' => ['required', 'max:20'],
            'address' => ['required', 'max:255'],
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;
        $address->address = $request->address;
        $address->save();

        toastr('Create successfully', 'success');

        return redirect()->route('user.address.index');
    }

    public function edit($id)
    {
        $address = UserAddress::findOrFail($id);
        return view('frontend.dashboard.address.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255,' . $id],
            'phone' => ['required', 'max:20,' . $id],
            'country' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'zipcode' => ['required', 'max:20'],
            'address' => ['required', 'max:255'],
        ]);

        $address = UserAddress::findOrFail($id);
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;
        $address->address = $request->address;
        $address->update();

        toastr('Updated successfully', 'success');

        return redirect()->route('user.address.index');
    }


    public function destroy($id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete successfully!',
        ]);
    }
}
