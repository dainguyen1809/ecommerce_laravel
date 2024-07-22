<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCondition;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegisterVendorController extends Controller
{
    use UploadImage;
    public function index()
    {
        $content = VendorCondition::first();

        return view('frontend.dashboard.vendor.index', compact('content'));
    }

    public function create(Request $request)
    {

        if (Auth::user()->role === 'vendor') {
            return redirect()->back();
        }

        $request->validate([
            'banner' => 'required|max:2048',
            'shop_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'description' => 'required|max:300',
            'fb_link' => 'nullable|url|max:255',
            'ins_link' => 'nullable|url|max:255',
        ]);

        $imagePath = $this->uploadImage($request, 'banner', 'images/vendors');

        $vendor = new Vendor();
        $vendor->user_id = Auth::user()->id;
        $vendor->banner = $imagePath;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->status = 0;
        $vendor->fb_link = $request->fb_link;
        $vendor->ins_link = $request->ins_link;
        $vendor->save();

        toastr('Submitted. Please wait for approved', 'info');
        return redirect()->back();
    }
}
