<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\active;

class VendorProductVariantController extends Controller
{
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        return $dataTable->render('vendor.product.product-variant.index', [
            'product' => $product,
        ]);
    }

    public function create()
    {
        return view('vendor.product.product-variant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => ['integer', 'required'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ]);

        $variant = new ProductVariant();
        $variant->product_id = $request->product;
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('Created', 'success');
        return redirect()->route('vendor.products-variant.index', [
            'product' => $request->product,
        ]);
    }

    public function edit($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        if ($productVariant->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }
        return view('vendor.product.product-variant.edit', [
            'productVariant' => $productVariant,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ]);

        $variant = ProductVariant::findOrFail($id);
        if ($variant->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('Updated', 'success');
        return redirect()->route('vendor.products-variant.index', [
            'product' => $variant->product_id,
        ]);
    }

    public function destroy($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variantCheck = ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if ($variantCheck > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This items contain variant items. Please delete variant items before deleting them!',
            ]);
        }
        $variant->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $varinat = ProductVariant::findOrFail($request->id);
        $varinat->status = $request->status == 'true' ? 1 : 0;
        $varinat->save();

        return response(['message' => 'Status has been updated!']);
    }
}
