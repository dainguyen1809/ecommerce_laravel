<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // daily
        $todayOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todayPendingOrder = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')->count();

        // earning
        $todayEarning = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())->sum('sub_total');
        $monthEarning = Order::where('order_status', '!=', 'canceled')
            ->whereMonth('created_at', Carbon::now()->month)->sum('sub_total');
        $yearEarning = Order::where('order_status', '!=', 'canceled')
            ->whereYear('created_at', Carbon::now()->year)->sum('sub_total');

        // customers
        $subscribers = Subscriber::count();
        $admins = User::where('role', 'admin')->count();
        $vendors = User::where('role', 'vendor')->count();
        $customers = User::where('role', 'user')->count();

        // totals
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status', 'pending')->count();
        $totalCanceledOrders = Order::where('order_status', 'canceled')->count();
        $totalCompletedOrders = Order::where('order_status', 'delivered')->count();
        $totalReviews = ProductReview::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', [
            'todayOrder' => $todayOrder,
            'todayPendingOrder' => $todayPendingOrder,
            'todayEarning' => $todayEarning,
            'totalOrders' => $totalOrders,
            'monthEarning' => $monthEarning,
            'yearEarning' => $yearEarning,
            'subscribers' => $subscribers,
            'admins' => $admins,
            'vendors' => $vendors,
            'customers' => $customers,
            'totalPendingOrders' => $totalPendingOrders,
            'totalCanceledOrders' => $totalCanceledOrders,
            'totalCompletedOrders' => $totalCompletedOrders,
            'totalReviews' => $totalReviews,
            'totalBrands' => $totalBrands,
            'totalCategories' => $totalCategories,
        ]);
    }

    public function login()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
}
