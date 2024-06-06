<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorShopProfile\StoreVendorShopProfileRequest;
use App\Models\Vendor;
use App\Models\VendorShopProfile;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use UploadImage;
    private $model;
    public function __construct()
    {
        $this->model = new Vendor();
    }
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('vendor.shop-profile.index', [
            'profile' => $profile,
        ]);
    }

    public function store(StoreVendorShopProfileRequest $request)
    {
        $vendor = $this->model->where('user_id', Auth::user()->id)->first();
        $bannerPath = $this->updateImage(
            $request,
            'banner',
            'images/vendors',
            $vendor->banner
        );
        $vendor->fill($request->validated());
        $vendor->banner = empty(! $bannerPath) ? $bannerPath : $vendor->banner;
        $vendor->save();


        toastr('Update Successfully', 'success');

        return redirect()->back();
    }
}
