<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\active;

class ProductController extends Controller
{
    use UploadImage;
    private $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', [
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

    public function store(StoreProductRequest $request)
    {
        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'images/products');

        $product = $this->model;
        $product = $this->model->fill($request->validated());
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = str()->slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->is_approved = 1;
        $product->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.products.index');

    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        return view('admin.product.edit', [
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
            'video_link' => ['required', 'url'],
            'sku' => ['required', 'max:100'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            'product_type' => ['required'],
        ]);

        $product = $this->model->findOrFail($id);
        $imagePath = $this->updateImage($request, 'image', 'images/products', $product->thumb_image);
        $product->thumb_image = empty(! $imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = str()->slug($request->name);
        // $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        // $product->is_approved = 1;
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

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);

        // delete main image
        $this->deleteImage($product->thumb_image);

        // delete product gallery image
        $galleryImage = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImage as $gallery) {
            $this->deleteImage($gallery->image);
            $gallery->delete();
        }

        // delete product variant if exist
        $variants = ProductVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $active = $this->model->findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Status has been updated!']);
    }
}
