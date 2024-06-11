<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flashSale = FlashSale::first();
        $products = Product::where('is_approved', 1)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
        return $dataTable->render('admin.flash-sale.index', [
            'flashSale' => $flashSale,
            'products' => $products,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        toastr('Updated Successfully!', 'success', 'Success');

        return redirect()->back();

    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ]);

        $flashSale = FlashSale::first();
        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->flash_sale_id = $flashSale->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Added Product Success', 'success');

        return redirect()->back();
    }

    public function changeShowAtHome(Request $request)
    {
        $active = FlashSaleItem::findOrFail($request->id);
        $active->show_at_home = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Show At Home has been updated!']);
    }

    public function changeStatus(Request $request)
    {
        $active = FlashSaleItem::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy($id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
        return response([
            'status' => 'success',
            'message' => 'Delete success!',
        ]);

    }
}
