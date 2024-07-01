<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function show($id)
    {
        $order = Order::with([
            'orderProducts',
        ])->findOrFail($id);

        $address = json_decode($order->order_address);
        $shipping = json_decode($order->shipping_method);
        $coupon = json_decode($order->coupon);

        return view('frontend.dashboard.order.show', [
            'order' => $order,
            'address' => $address,
            'shipping' => $shipping,
            'coupon' => $coupon,
        ]);
    }
}
