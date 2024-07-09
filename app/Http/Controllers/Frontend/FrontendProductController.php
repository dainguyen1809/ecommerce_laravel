<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where([
                'category_id' => $category->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $from = $price[0];
                    $to = $price[1];

                    $query->where('price', '>=', $from)
                        ->where('price', '<=', $to);
                })
                ->paginate(2);
        } elseif ($request->has('prod')) {
            $subCategory = SubCategory::where('slug', $request->prod)->firstOrFail();
            $products = Product::where([
                'sub_category_id' => $subCategory->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $from = $price[0];
                    $to = $price[1];

                    $query->where('price', '>=', $from)
                        ->where('price', '<=', $to);
                })
                ->paginate(2);
        } elseif ($request->has('type')) {
            $childCategory = ChildCategory::where('slug', $request->type)->firstOrFail();
            $products = Product::where([
                'child_category_id' => $childCategory->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $from = $price[0];
                    $to = $price[1];

                    $query->where('price', '>=', $from)
                        ->where('price', '<=', $to);
                })
                ->paginate(2);
        } else if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();
            $products = Product::where([
                'brand_id' => $brand->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $from = $price[0];
                    $to = $price[1];

                    $query->where('price', '>=', $from)
                        ->where('price', '<=', $to);
                })->paginate(2);
        } elseif ($request->has('search')) {
            $products = Product::where([
                'status' => 1,
                'is_approved' => 1,
            ])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('long_description', 'like', '%' . $request->search . '%');
                        });
                })->paginate(12);
        } else {
            $products = Product::where([
                'status' => 1,
                'is_approved' => 1,
            ])->orderBy('id', 'desc')->paginate(12);
        }

        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('frontend.pages.product', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function productDetail($slug)
    {
        $product = Product::with([
            'vendor',
            'category',
            'productImageGalleries',
            'productVariants',
            'brand',
        ])->where('slug', $slug)->where('status', 1)->first();

        $flashSaleItems = $product ? FlashSaleItem::where('status', 1)
            ->where('product_id', $product->id)
            ->orderBy('id', 'desc')
            ->paginate(5) : collect();
        $counterFlashSale = FlashSale::first();

        return view('frontend.pages.product-detail', [
            'product' => $product,
            'flashSaleItems' => $flashSaleItems,
            'counterFlashSale' => $counterFlashSale,
        ]);
    }

    public function changeProductView(Request $request)
    {
        session()->put('product_list_style', $request->style);
    }
}
