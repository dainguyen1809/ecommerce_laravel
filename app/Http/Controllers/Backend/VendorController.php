<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VendorController extends Controller
{
    public function dashboard()
    {
        // statistics today

        $todayOrder = Order::whereDate('created_at', Carbon::today())
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->count();
        $todayPendingOrder = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->count();

        // statistics earnings 

        $todayEarning = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->sum('sub_total');
        // monthly
        $monthEarning = Order::where('order_status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->sum('sub_total');
        // yearly
        $yearEarning = Order::where('order_status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->year)
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->sum('sub_total');
        ////////////

        $totalOrder = Order::whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })->count();
        $totalOrder = Order::whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })->count();
        $pendingOrder = Order::where('order_status', 'pending')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->count();
        $completedOrder = Order::where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->count();
        $totalProduct = Product::where('vendor_id', auth()->user()->vendor->id)->count();
        $totalEarning = Order::where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->sum('sub_total');
        $reviews = ProductReview::whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })->count();

        return view('vendor.dashboard.dashboard', [
            'todayOrder' => $todayOrder,
            'todayPendingOrder' => $todayPendingOrder,
            'totalOrder' => $totalOrder,
            'pendingOrder' => $pendingOrder,
            'completedOrder' => $completedOrder,
            'totalProduct' => $totalProduct,
            'todayEarning' => $todayEarning,
            'monthEarning' => $monthEarning,
            'yearEarning' => $yearEarning,
            'totalEarning' => $totalEarning,
            'reviews' => $reviews,
        ]);
    }
}
