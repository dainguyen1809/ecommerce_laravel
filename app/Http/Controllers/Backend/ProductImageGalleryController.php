<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{
    use UploadImage;
    public function index(Request $request, ProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.image-gallery.index', [
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

        $productImag = ProductImageGallery::findOrFail($id);
        $this->deleteImage($productImag->images);
        $productImag->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted !!',
        ]);
    }
}
