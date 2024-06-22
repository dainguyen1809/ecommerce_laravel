<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethods = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', [
            'addresses' => $addresses,
            'shippingMethods' => $shippingMethods,
        ]);
    }

    public function addressCreate(Request $request)
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

        return redirect()->back();
    }

    public function checkoutFormSubmit(Request $request)
    {
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'shipping_address_id' => ['required', 'integer'],
        ]);

        $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
        if ($shippingMethod) {
            session()->put('shipping_method', [
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' => $shippingMethod->type,
                'cost' => $shippingMethod->cost,
            ]);
        }
        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($address) {
            session()->put('address', $address);
        }
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('user.payment'),
        ]);
    }
}
