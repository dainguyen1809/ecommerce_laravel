<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('tracker')) {
            $order = Order::where('invoice_id', $request->tracker)->first();
            return view('frontend.pages.order-tracking', compact('order'));
        }
        return view('frontend.pages.order-tracking');
    }

}
