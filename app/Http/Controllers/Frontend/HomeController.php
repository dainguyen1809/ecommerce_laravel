<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
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
        return view('frontend.home.home', [
            'sliders' => $sliders,
            'counterFlashSale' => $counterFlashSale,
            'flashSaleItems' => $flashSaleItems,
        ]);
    }
}
