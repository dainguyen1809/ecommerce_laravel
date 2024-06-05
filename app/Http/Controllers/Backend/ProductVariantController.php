<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

use function App\Helpers\active;

class ProductVariantController extends Controller
{
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {

        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.product-variant.index', [
            'product' => $product,
        ]);
    }

    public function create()
    {
        return view('admin.product.product-variant.create');
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
        return redirect()->route('admin.products-variant.index', [
            'product' => $request->product,
        ]);
    }

    public function edit($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        return view('admin.product.product-variant.edit', [
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
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('Updated', 'success');
        return redirect()->route('admin.products-variant.index', [
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
        active($request, ProductVariant::findOrFail($request->id));
    }
}
