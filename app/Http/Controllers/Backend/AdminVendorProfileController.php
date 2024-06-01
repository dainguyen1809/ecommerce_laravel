<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorProfile\StoreVendorProfileRequest;
use App\Models\Vendor;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Auth;


class AdminVendorProfileController extends Controller
{
    use UploadImage;
    private $model;
    public function __construct()
    {
        $this->model = new Vendor();
    }
    public function index()
    {
        $profile = $this->model->where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', [
            'profile' => $profile,
        ]);
    }

    public function store(StoreVendorProfileRequest $request)
    {
        // 
        // $vendor = $this->model->fill($request->validated());
        // $vendor->banner = $logoPath;
        // $vendor->save();

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
