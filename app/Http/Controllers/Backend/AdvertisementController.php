<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use UploadImage;
    public function index()
    {
        $bannerOne = Advertisement::where('key', 'homepage_banner_section_one')->first();
        $bannerOne = json_decode($bannerOne?->value);

        $bannerTwo = Advertisement::where('key', 'homepage_banner_section_two')->first();
        $bannerTwo = json_decode($bannerTwo?->value);

        $bannerThree = Advertisement::where('key', 'homepage_banner_section_three')->first();
        $bannerThree = json_decode($bannerThree?->value);

        $bannerFour = Advertisement::where('key', 'homepage_banner_section_four')->first();
        $bannerFour = json_decode($bannerFour?->value);

        $productBanner = Advertisement::where('key', 'product_page_banner')->first();
        $productBanner = json_decode($productBanner?->value);

        $cartBanner = Advertisement::where('key', 'cart_page_banner')->first();
        $cartBanner = json_decode($cartBanner?->value);

        return view('admin.advertisement.index', [
            'bannerOne' => $bannerOne,
            'bannerTwo' => $bannerTwo,
            'bannerThree' => $bannerThree,
            'bannerFour' => $bannerFour,
            'productBanner' => $productBanner,
            'cartBanner' => $cartBanner,
        ]);
    }

    public function bannerOne(Request $request)
    {
        $request->validate([
            'banner_img' => 'image|max:2048',
            'banner_url' => 'required',
        ]);

        $bannerImage = $this->updateImage($request, 'banner_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0,
            ],
        ];

        if (! empty($bannerImage)) {
            $value['banner_one']['banner_img'] = $bannerImage;
        } else {
            $value['banner_one']['banner_img'] = $request->banner_old_img;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_one'],
            ['value' => $value]
        );

        toastr('Done', 'success');

        return redirect()->back();
    }

    public function bannerTwo(Request $request)
    {
        $request->validate([
            'banner_one_img' => 'image|max:2048',
            'banner_one_url' => 'required',
            'banner_two_img' => 'image|max:2048',
            'banner_two_url' => 'required',
        ]);

        $bannerImage = $this->updateImage($request, 'banner_one_img', 'images/banners');
        $bannerImageTwo = $this->updateImage($request, 'banner_two_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0,
            ],
        ];

        if (! empty($bannerImage)) {
            $value['banner_one']['banner_img'] = $bannerImage;
        } else {
            $value['banner_one']['banner_img'] = $request->banner_one_old_img;
        }

        if (! empty($bannerImageTwo)) {
            $value['banner_two']['banner_img'] = $bannerImageTwo;
        } else {
            $value['banner_two']['banner_img'] = $request->banner_two_old_img;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_two'],
            ['value' => $value]
        );

        toastr('Done', 'success');

        return redirect()->back();
    }

    public function bannerThree(Request $request)
    {

        $request->validate([
            'banner_one_img' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required'],
            'banner_three_image' => ['image'],
            'banner_three_url' => ['required'],
        ]);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'banner_one_img', 'images/banners');
        $imagePathTwo = $this->updateImage($request, 'banner_two_img', 'images/banners');
        $imagePathThree = $this->updateImage($request, 'banner_three_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0
            ],
            'banner_three' => [
                'banner_url' => $request->banner_three_url,
                'status' => $request->banner_three_status == 'on' ? 1 : 0
            ]
        ];
        if (! empty($imagePath)) {
            $value['banner_one']['banner_img'] = $imagePath;
        } else {
            $value['banner_one']['banner_img'] = $request->banner_one_old_img;
        }

        if (! empty($imagePathTwo)) {
            $value['banner_two']['banner_img'] = $imagePathTwo;
        } else {
            $value['banner_two']['banner_img'] = $request->banner_two_old_img;
        }

        if (! empty($imagePathThree)) {
            $value['banner_three']['banner_img'] = $imagePathThree;
        } else {
            $value['banner_three']['banner_img'] = $request->banner_three_old_image;
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_three'],
            ['value' => $value]
        );

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->back();
    }

    public function bannerFour(Request $request)
    {
        $request->validate([
            'banner_img' => 'image|max:2048',
            'banner_url' => 'required',
        ]);

        $bannerImage = $this->updateImage($request, 'banner_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0,
            ],
        ];

        if (! empty($bannerImage)) {
            $value['banner_one']['banner_img'] = $bannerImage;
        } else {
            $value['banner_one']['banner_img'] = $request->banner_old_img;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner_section_four'],
            ['value' => $value]
        );

        toastr('Done', 'success');

        return redirect()->back();
    }

    public function productBanner(Request $request)
    {
        $request->validate([
            'banner_img' => 'image|max:2048',
            'banner_url' => 'required',
        ]);

        $bannerImage = $this->updateImage($request, 'banner_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0,
            ],
        ];

        if (! empty($bannerImage)) {
            $value['banner_one']['banner_img'] = $bannerImage;
        } else {
            $value['banner_one']['banner_img'] = $request->banner_old_img;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'product_page_banner'],
            ['value' => $value]
        );

        toastr('Done', 'success');

        return redirect()->back();
    }


    public function cartBanner(Request $request)
    {
        $request->validate([
            'banner_one_img' => 'image|max:2048',
            'banner_one_url' => 'required',
            'banner_two_img' => 'image|max:2048',
            'banner_two_url' => 'required',
        ]);

        $bannerImage = $this->updateImage($request, 'banner_one_img', 'images/banners');
        $bannerImageTwo = $this->updateImage($request, 'banner_two_img', 'images/banners');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0,
            ],
        ];

        if (! empty($bannerImage)) {
            $value['banner_one']['banner_img'] = $bannerImage;
        } else {
            $value['banner_one']['banner_img'] = $request->cart_banner_one_old_img;
        }

        if (! empty($bannerImageTwo)) {
            $value['banner_two']['banner_img'] = $bannerImageTwo;
        } else {
            $value['banner_two']['banner_img'] = $request->cart_banner_two_old_img;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'cart_page_banner'],
            ['value' => $value]
        );

        toastr('Done', 'success');

        return redirect()->back();
    }

}
