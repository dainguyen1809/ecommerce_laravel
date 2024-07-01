<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $dataTable)
    {
        return $dataTable->render('vendor.order.index');
    }


    public function show($id)
    {
        $order = Order::with([
            'orderProducts',
        ])->findOrFail($id);

        $address = json_decode($order->order_address);
        // dd($address);
        return view('vendor.order.show', [
            'order' => $order,
            'address' => $address,
        ]);
    }

    public function orderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();

        toastr('Status updated', 'success');

        return redirect()->back();
    }
}
