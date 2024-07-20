<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $counterFlashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status', 1)->orderBy('id', 'asc')->paginate(4);

        $bannerTwo = Advertisement::where('key', 'homepage_banner_section_two')->first();
        $bannerTwo = json_decode($bannerTwo?->value);

        return view('frontend.pages.flash-sale', [
            'counterFlashSale' => $counterFlashSale,
            'flashSaleItems' => $flashSaleItems,
            'bannerTwo' => $bannerTwo,
        ]);
    }
}
