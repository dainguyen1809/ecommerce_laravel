<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use UploadImage;
    // private $model;

    // public function __construct()
    // {
    //     $this->model = new ProductImageGallery();
    // }
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        return $dataTable->render('vendor.product.image-gallery.index', [
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'max:2048']
        ]);

        $imagePaths = $this->uploadMultiImage($request, 'images', 'images/galleries');
        foreach ($imagePaths as $path) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->images = $path;
            $productImageGallery->product_id = $request->product;
            $productImageGallery->save();
        }

        toastr('Uploaded !', 'success');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $productImg = ProductImageGallery::findOrFail($id);
        if ($productImg->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }
        $this->deleteImage($productImg->images);
        $productImg->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted !!',
        ]);
    }
}
