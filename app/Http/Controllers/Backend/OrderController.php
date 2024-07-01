<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DroppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        $shipping = json_decode($order->shipping_method);
        $coupon = json_decode($order->coupon);
        return view('admin.order.detail', [
            'order' => $order,
            'address' => $address,
            'shipping' => $shipping,
            'coupon' => $coupon,
        ]);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'status updated',
        ]);
    }

    public function changePaymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->status;
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'status updated',
        ]);
    }

    public function pendingOrder(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending');
    }

    public function droppedOffOrder(DroppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-off');
    }

    public function shippedOrder(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped');
    }

    public function processedOrder(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // order product
        $order->orderProducts()->delete();
        // transaction
        $order->transaction()->delete();

        $order->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Done',
        ]);
    }

}
