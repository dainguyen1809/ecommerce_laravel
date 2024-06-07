<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\VendorProduct\StoreVendorProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    use UploadImage;
    private $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function getSubCategories(Request $request)
    {

        $subCategories = SubCategory::where('category_id', $request->id)
            ->where('status', 1)
            ->get();

        return $subCategories;
    }
    public function getChildCategories(Request $request)
    {

        $childCategories = ChildCategory::where('sub_category_id', $request->id)
            ->where('status', 1)
            ->get();

        return $childCategories;
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            'product_type' => ['required'],
        ]);

        $product = $this->model;
        $imagePath = $this->updateImage($request, 'image', 'images/products', $product->thumb_image);
        $product->thumb_image = empty(! $imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = str()->slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->is_approved = 1;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Create successfully', 'success');

        return redirect()->route('vendor.products.index');
    }

    public function edit(Product $product)
    {
        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        return view('vendor.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'subCategories' => $subCategories,
            'childCategories' => $childCategories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
        ]);


        $product = $this->model->findOrFail($id);

        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        $imagePath = $this->updateImage($request, 'image', 'images/products', $product->thumb_image);
        $product->thumb_image = empty(! $imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = str()->slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->is_approved = $product->is_approved;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Update successfully', 'success');

        return redirect()->route('vendor.products.index');
    }

}
