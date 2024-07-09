<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category')->first();
        $popularCategorySection = json_decode($popularCategory->value);
        $sliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $sliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $weeklyProducts = HomePageSetting::where('key', 'weekly-products')->first();

        return view('admin.home-page-setting.index', [
            'categories' => $categories,
            'popularCategorySection' => $popularCategorySection,
            'sliderSectionOne' => $sliderSectionOne,
            'sliderSectionTwo' => $sliderSectionTwo,
            'weeklyProducts' => $weeklyProducts,
        ]);
    }

    public function updatePopularCategory(Request $request)
    {
        $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two,
            ],
            [
                'category' => $request->cat_three,
                'sub_category' => $request->sub_cat_three,
                'child_category' => $request->child_cat_three,
            ],
            [
                'category' => $request->cat_four,
                'sub_category' => $request->sub_cat_four,
                'child_category' => $request->child_cat_four,
            ],
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'popular_category'],
            ['value' => json_encode($data)]
        );

        toastr('Done', 'success');
        return redirect()->back();
    }

    public function updateProductSliderSectionOne(Request $request)
    {

        $request->validate([
            'cat_one' => 'required',
        ]);

        $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'product_slider_section_one'],
            ['value' => json_encode($data)]
        );

        toastr('Done', 'success');
        return redirect()->back();
    }

    public function updateProductSliderSectionTwo(Request $request)
    {

        $request->validate([
            'cat_one' => 'required',
        ]);

        $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'product_slider_section_two'],
            ['value' => json_encode($data)]
        );

        toastr('Done', 'success');
        return redirect()->back();
    }

    public function weekylyBestProduct(Request $request)
    {
        $request->validate([
            'cat_one' => 'required',
            'cat_two' => 'required',
        ], [
            'cat_one.required' => 'Rated product is required',
            'cat_two.required' => 'Best sale product is required',
        ]);

        $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two,
            ],
        ];

        HomePageSetting::updateOrCreate(
            ['key' => 'weekly-products'],
            ['value' => json_encode($data)]
        );

        toastr('Done', 'success');
        return redirect()->back();
    }

}
