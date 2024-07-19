<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // query builder
        $sliders = Slider::where('status', 1)
            ->orderBy('serial', 'asc')
            ->get();
        $counterFlashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)
            ->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category')->first();

        $brands = Brand::where('status', 1)
            ->where('is_featured', 1)
            ->get();
        // $popularCategory = HomePageSetting::where('key', 'popular_category')->first();

        $typeProducts = $this->getProductByType();
        $productByCategoryOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $productByCategoryTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $weeklyProduct = HomePageSetting::where('key', 'weekly-products')->first();

        $bannerOne = Advertisement::where('key', 'homepage_banner_section_one')->first();
        $bannerOne = json_decode($bannerOne?->value);

        $bannerTwo = Advertisement::where('key', 'homepage_banner_section_two')->first();
        $bannerTwo = json_decode($bannerTwo?->value);

        $bannerThree = Advertisement::where('key', 'homepage_banner_section_three')->first();
        $bannerThree = json_decode($bannerThree?->value);

        $bannerFour = Advertisement::where('key', 'homepage_banner_section_four')->first();
        $bannerFour = json_decode($bannerFour?->value);


        return view('frontend.home.home', [
            'sliders' => $sliders,
            'counterFlashSale' => $counterFlashSale,
            'flashSaleItems' => $flashSaleItems,
            'popularCategory' => $popularCategory,
            'brands' => $brands,
            'typeProducts' => $typeProducts,
            'productByCategoryOne' => $productByCategoryOne,
            'productByCategoryTwo' => $productByCategoryTwo,
            'weeklyProduct' => $weeklyProduct,
            'bannerOne' => $bannerOne,
            'bannerTwo' => $bannerTwo,
            'bannerThree' => $bannerThree,
            'bannerFour' => $bannerFour,
        ]);
    }

    public function getProductByType()
    {
        $typeProducts = [];

        $typeProducts['new_arrival'] = Product::where([
            'product_type' => 'new_arrival',
            'is_approved' => 1,
            'status' => 1,
        ])->orderBy('id', 'desc')->take(8)->get();
        $typeProducts['featured_product'] = Product::where([
            'product_type' => 'featured_product',
            'is_approved' => 1,
            'status' => 1,
        ])->orderBy('id', 'desc')->take(8)->get();
        $typeProducts['best_product'] = Product::where([
            'product_type' => 'best_product',
            'is_approved' => 1,
            'status' => 1,
        ])->orderBy('id', 'desc')->take(8)->get();

        return $typeProducts;
    }
}
