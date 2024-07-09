<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $counterFlashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status', 1)->orderBy('id', 'asc')->paginate(4);
        return view('frontend.pages.flash-sale', [
            'counterFlashSale' => $counterFlashSale,
            'flashSaleItems' => $flashSaleItems,
        ]);
    }
}
