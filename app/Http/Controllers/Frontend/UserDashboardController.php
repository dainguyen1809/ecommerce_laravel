<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\UserAddress;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalOrder = Order::where('user_id', auth()->user()->id)->count();
        $pendingOrder = Order::where('user_id', auth()->user()->id)
            ->where('order_status', 'pending')
            ->count();
        $completedOrder = Order::where('user_id', auth()->user()->id)
            ->where('order_status', 'delivered')
            ->count();
        $review = ProductReview::where('user_id', auth()->user()->id)->count();
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->count();
        $address = UserAddress::where('user_id', auth()->user()->id)->count();
        return view('frontend.dashboard.dashboard', [
            'totalOrder' => $totalOrder,
            'pendingOrder' => $pendingOrder,
            'completedOrder' => $completedOrder,
            'review' => $review,
            'wishlist' => $wishlist,
            'address' => $address,
        ]);
    }
}
