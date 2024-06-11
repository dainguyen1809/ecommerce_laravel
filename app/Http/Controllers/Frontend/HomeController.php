<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
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
        return view('frontend.home.home', [
            'sliders' => $sliders,
            'counterFlashSale' => $counterFlashSale,
        ]);
    }
}
