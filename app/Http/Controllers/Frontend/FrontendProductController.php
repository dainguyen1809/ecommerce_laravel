<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
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
}
